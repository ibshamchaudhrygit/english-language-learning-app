<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\QuizAttempt;

class StudentProgressController extends Controller
{
    /**
     * Display a list of students and their progress.
     */
    public function index()
    {
        // For now, just load the view.
        // You can add data logic here later, e.g.:
        // $students = User::where('role', 'user')->with('quizAttempts')->get();
        return view('instructor.progress');
    }
}