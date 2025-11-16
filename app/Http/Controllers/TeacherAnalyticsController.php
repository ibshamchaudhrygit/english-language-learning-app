<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherAnalyticsController extends Controller
{
    /**
     * Display analytics for the teacher's courses/quizzes.
     */
    public function index()
    {
        // For now, just load the view.
        return view('instructor.analytics');
    }
}