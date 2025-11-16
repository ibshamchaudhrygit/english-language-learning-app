<?php

use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;

Route::get('/', function () {
    return view('index');
});

Route::get("/contact", [\App\Http\Controllers\ContactController::class,"index"]);


Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');


Route::get('/lessons', function () {
    $lessons = Lesson::all();
    return view('lessons.index',
        [
        'lessons' => $lessons
        ]);
});


Route::get("/messages",function(){
    $messages = \App\Models\Message::all();
    return view('messages.index' ,
        [
            'messages' => $messages
        ]
    );
});


Route::get("/messages/create",function(){
    return view('messages.create');
});


Route::post("/messages/create",function(){
  \App\Models\Message::create([
      "title" => request('title'),
      "body" => request('body'),
      "user_id" => Auth::user()->id
  ]);
});


Route::get("/messages/{id}",function($id){
    $message = \App\Models\Message::find($id);
    return view('messages.show' ,
        [
            'message' => $message
        ]
    );
});

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
        $questions = $quiz->questions;
        return view('quizzes.show',[
            'quiz' => $quiz,
            'questions' => $questions
        ]);
    });

    Route::post('/quiz/submit/{id}/{user_id}', function ($id,$user_id) {
        $score = request()->all()["score"];
        // authorize first
        \App\Models\QuizAttempt::create([
            "quiz_id" => $id,
            "user_id" => $user_id,
            "score" => $score
        ]);

        return redirect("/performance");
    });

    Route::get('/performance', function () {
        $quiz_track = \App\Models\QuizAttempt::where('user_id',Auth::user()->id)->get();

        return view('performance.show',[
            "quiz_track" => $quiz_track,
            "user_id" => Auth::user()->id
        ]);
    });
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
        $quiz = \App\Models\Quiz::find($id);
        $questions = $quiz->questions;
        return view("instructor.quizEdit",[
            "quiz" => $quiz,
            "questions" => $questions
        ]);
    });

    Route::get("/teacher/quiz/create", function () {
        $teacherId = Auth::user()->id;
        $lessons = \App\Models\Lesson::where("user_id", $teacherId)->get();

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

        $quiz = \App\Models\Quiz::create([
            "title" => $request->title,
            "lesson_id" => $request->lesson_id,
            "user_id" => Auth::user()->id,
        ]);

        return redirect("/teacher/quiz/{$quiz->id}/edit")
            ->with("success", "Quiz created successfully! Now add questions.");
    });


    Route::post("/teacher/quiz/{quiz}/questions",function($quiz){
        $request = request();
        \App\Models\Question::create([
            "quiz_id" => $quiz,
            "title" => $request->title,
            "option_a" => $request->option_a,
            "option_b" => $request->option_b,
            "option_c" => $request->option_c,
            "option_d" => $request->option_d,
            "correct_answer" => $request->correct_answer,
        ]);
        return back()->with("success", "Question added!");
    });

    Route::post("/teacher/questions/{id}/update", function(\Illuminate\Http\Request $request, $id) {
        $question = \App\Models\Question::findOrFail($id);
        $question->update($request->only([
            "title","option_a","option_b","option_c","option_d","correct_answer"
        ]));
        return back()->with("success", "Question updated!");
    });

    Route::delete("/teacher/questions/{id}", function($id) {
        \App\Models\Question::findOrFail($id)->delete();
        return back()->with("success", "Question deleted!");
    });

    Route::delete("/teacher/quiz/{id}/delete",function($id){

        $quiz = \App\Models\Quiz::find($id);
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
        $teachers = \App\Models\User::where('role', "teacher")->get();
        return view("admin.createLesson", [
            "teachers" => $teachers,
        ]);
    });

    Route::post("/admin/content", function () {
        Lesson::create([
            "title" => request("title"),
            "description" => request("description"),
            "image" => request("image"),
            "video_url" => request("video_url"),
            "price" => request("price"),
            "duration" => request("duration"),
            "enrollments" => request("enrollments"),
            "user_id" => request("user_id"),
        ]);
        return redirect("/admin/content")->with("success", "Lesson added!");
    });

    Route::get("/admin/content/{id}/edit", function ($id) {
        $lesson = Lesson::find($id);
        return view("admin.editLesson", [
            "lesson" => $lesson
        ]);
    });

    Route::patch("/admin/content/{id}", function ($id) {
        $lesson = Lesson::find($id);
        $lesson->update([
            "title" => request("title"),
            "description" => request("description"),
            "image" => request("image"),
            "video_url" => request("video_url"),
            "price" => request("price"),
            "duration" => request("duration"),
            "enrollments" => request("enrollments"),
        ]);
        return redirect("/admin/content")->with("success", "Lesson updated!");
    });

    Route::delete("/admin/content/{lesson}", function (Lesson $lesson) {
        $lesson->delete();
        return redirect("/admin/content")->with("success", "Lesson deleted!");
    });
});






