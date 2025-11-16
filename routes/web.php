<?php

use App\Models\Lesson;
use App\Models\Message;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\User;
use App\Models\QuizAttempt;
use App\Models\Certificate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\GamificationController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('index');
});

Route::get("/contact", [ContactController::class,"index"]);


Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');


Route::get('/lessons', function () {
    // You can add filtering here later
    // e.g., $query = Lesson::query();
    // if (request('category')) { ... }
    $lessons = Lesson::orderBy('skill_level')->orderBy('title')->get();
    
    return view('lessons.index',
        [
        'lessons' => $lessons
        ]);
});

// --- GAMIFICATION & CERTIFICATES (Public) ---
Route::get('/leaderboard', [GamificationController::class, 'leaderboard']);


Route::get("/messages",function(){
    // This now fetches only top-level threads for the main forum view
    $messages = Message::whereNull('parent_id')->with('user', 'replies')->orderBy('created_at', 'desc')->get();
    return view('messages.index' ,
        [
            'messages' => $messages // These are now 'threads'
        ]
    );
});


Route::get("/messages/create",function(){
    return view('messages.create'); // This view is for creating a new THREAD
});


Route::post("/messages/create",function(){
  Message::create([
      "title" => request('title'),
      "body" => request('body'),
      "user_id" => Auth::user()->id,
      "parent_id" => null // Explicitly null for a new thread
  ]);
  return redirect('/messages');
});


Route::get("/messages/{id}",function($id){
    // This now shows a single THREAD and all its REPLIES
    $message = Message::with('user', 'replies.user')->findOrFail($id);
    return view('messages.show' ,
        [
            'message' => $message // This is the parent 'thread'
        ]
    );
});

// --- NEW ROUTE: Post a reply to a thread ---
Route::post("/messages/{id}/reply", function($id){
    Message::create([
        "title" => "Reply", // Replies don't need a title, but schema has it
        "body" => request('body'),
        "user_id" => Auth::user()->id,
        "parent_id" => $id // Link this message to the parent thread
    ]);
    return back()->with('success', 'Reply posted!');
})->middleware('auth');


//Middleware

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/lessons/{id}', function ($id) {
        $lesson = Lesson::find($id);
        return view('lessons.show',[
            'lesson' => $lesson
        ]);
    });

    Route::get('/quiz/lessons/{id}', function ($id) {
        $lesson = Lesson::find($id);
        $quiz = $lesson->quiz;
        // Eager load questions
        $quiz->load('questions');
        return view('quizzes.show',[
            'quiz' => $quiz,
            'questions' => $quiz->questions
        ]);
    });

    Route::post('/quiz/submit/{id}/{user_id}', function ($id,$user_id) {
        $score = request()->all()["score"];
        // authorize first
        QuizAttempt::create([
            "quiz_id" => $id,
            "user_id" => $user_id,
            "score" => $score
        ]);
        
        // --- TODO: Add Gamification Logic Here ---
        // 1. Find user: $user = User::find($user_id);
        // 2. Add points: $user->increment('points', 10); // 10 points for a quiz
        // 3. Check for badges...

        return redirect("/performance");
    });

    Route::get('/performance', function () {
        $quiz_track = QuizAttempt::where('user_id',Auth::user()->id)->get();

        return view('performance.show',[
            "quiz_track" => $quiz_track,
            "user_id" => Auth::user()->id
        ]);
    });
    
    // --- GAMIFICATION & CERTIFICATES (User) ---
    Route::get('/certificates', [CertificateController::class, 'index']);
    Route::get('/certificates/{certificate}', [CertificateController::class, 'show']);
    Route::get('/my-badges', [GamificationController::class, 'badges']);
});


Route::middleware(['auth', 'role:teacher'])->group(function () {
    // Teacher Routes
    Route::get('/teacher', function () {
        return view('instructor.index');
    });

    Route::get("/teacher/quiz", function () {
        $user = Auth::user();   // get logged-in user
        $quizzes = $user->quiz; // quizzes via relationship

        return view("instructor.quiz", [
            "quizzes" => $quizzes
        ]);
    });

    Route::get("/teacher/lessons", function () {
        $user = Auth::user();
        $lessons = $user->lessons;
        return view("instructor.lessons",
            [
            "lessons" => $lessons,
            ]
        );
    });


    Route::get("/teacher/monitor",function(){
        return view("instructor.monitor");
    });

    Route::get("/teacher/live",function(){
        return view("instructor.live");
    });

    Route::get("/teacher/quiz/{id}/edit",function($id){
        $quiz = Quiz::find($id);
        $questions = $quiz->questions;
        return view("instructor.quizEdit",[
            "quiz" => $quiz,
            "questions" => $questions
        ]);
    });

    Route::get("/teacher/quiz/create", function () {
        $teacherId = Auth::user()->id;
        $lessons = Lesson::where("user_id", $teacherId)->get();

        return view("instructor.quizCreate", [
            "lessons" => $lessons
        ]);
    });

    Route::post("/teacher/quiz/store", function ( ) {
        $request = request();
        $request->validate([
            "title" => "required|string|max:255",
            "lesson_id" => "nullable|exists:lessons,id",
        ]);

        $quiz = Quiz::create([
            "title" => $request->title,
            "lesson_id" => $request->lesson_id,
            "user_id" => Auth::user()->id,
        ]);

        return redirect("/teacher/quiz/{$quiz->id}/edit")
            ->with("success", "Quiz created successfully! Now add questions.");
    });


    Route::post("/teacher/quiz/{quiz}/questions",function($quiz){
        $request = request();
        // --- TODO: This needs validation based on question type ---
        Question::create([
            "quiz_id" => $quiz,
            "title" => $request->title,
            // "type" => $request->type, // Need to add this to the form
            "option_a" => $request->option_a,
            "option_b" => $request->option_b,
            "option_c" => $request->option_c,
            "option_d" => $request->option_d,
            "correct_answer" => $request->correct_answer,
            // "options" => $request->options // For matching
        ]);
        return back()->with("success", "Question added!");
    });

    Route::post("/teacher/questions/{id}/update", function(\Illuminate\Http\Request $request, $id) {
        $question = Question::findOrFail($id);
        $question->update($request->only([
            "title","option_a","option_b","option_c","option_d","correct_answer"
            // --- TODO: Add 'type' and 'options' ---
        ]));
        return back()->with("success", "Question updated!");
    });

    Route::delete("/teacher/questions/{id}", function($id) {
        Question::findOrFail($id)->delete();
        return back()->with("success", "Question deleted!");
    });

    Route::delete("/teacher/quiz/{id}/delete",function($id){

        $quiz = Quiz::find($id);
        $quiz->delete();
        return redirect("/teacher/quiz");
    });

});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get("/admin", function () {
        return view("admin.index");
    });

    Route::get("/admin/content", function () {
        $lessons = Lesson::all();
        return view("admin.content", [
            "lessons" => $lessons
        ]);
    });

    Route::get("/admin/content/create", function () {
        $teachers = User::where('role', "teacher")->get();
        return view("admin.createLesson", [
            "teachers" => $teachers,
        ]);
    });

    Route::post("/admin/content", function () {
        // --- UPDATED to include new fields ---
        Lesson::create([
            "title" => request("title"),
            "description" => request("description"),
            "skill_level" => request("skill_level"),
            "category" => request("category"),
            "image" => request("image"),
            "video_url" => request("video_url"),
            "audio_url" => request("audio_url"),
            "price" => request("price"),
            "duration" => request("duration"),
            "enrollments" => request("enrollments"),
            "user_id" => request("user_id"),
        ]);
        // --- END UPDATED ---
        return redirect("/admin/content")->with("success", "Lesson added!");
    });

    Route::get("/admin/content/{id}/edit", function ($id) {
        $lesson = Lesson::find($id);
        $teachers = User::where('role', "teacher")->get();
        return view("admin.editLesson", [
            "lesson" => $lesson,
            "teachers" => $teachers
        ]);
    });

    Route::patch("/admin/content/{id}", function ($id) {
        $lesson = Lesson::find($id);
        // --- UPDATED to include new fields ---
        $lesson->update([
            "title" => request("title"),
            "description" => request("description"),
            "skill_level" => request("skill_level"),
            "category" => request("category"),
            "image" => request("image"),
            "video_url" => request("video_url"),
            "audio_url" => request("audio_url"),
            "price" => request("price"),
            "duration" => request("duration"),
            "enrollments" => request("enrollments"),
            "user_id" => request("user_id"), // Added teacher update
        ]);
        // --- END UPDATED ---
        return redirect("/admin/content")->with("success", "Lesson updated!");
    });

    Route::delete("/admin/content/{lesson}", function (Lesson $lesson) {
        $lesson->delete();
        return redirect("/admin/content")->with("success", "Lesson deleted!");
    });

    // --- TODO: Add routes for Admin to manage Badges ---
    // e.g., Route::get('/admin/badges', [BadgeController::class, 'index']);

});