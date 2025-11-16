<?php

namespace App\Http\Controllers;

use App\Models\WritingPrompt;
use App\Models\WritingSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WritingPracticeController extends Controller
{
    /**
     * Display a listing of writing prompts.
     */
    public function index()
    {
        $prompts = WritingPrompt::orderBy('skill_level')->get();
        return view('writing.index', ['prompts' => $prompts]);
    }

    /**
     * Show the form for a specific prompt.
     */
    public function show(WritingPrompt $prompt)
    {
        return view('writing.show', ['prompt' => $prompt]);
    }

    /**
     * Store a new writing submission.
     */
    public function store(Request $request, WritingPrompt $prompt)
    {
        $request->validate(['body' => 'required|string|min:50']);

        WritingSubmission::create([
            'user_id' => Auth::id(),
            'writing_prompt_id' => $prompt->id,
            'body' => $request->body,
        ]);

        // TODO: Award points/badges for writing
        // Auth::user()->increment('points', 25);
        
        return redirect('/my-writing')->with('success', 'Your submission has been saved!');
    }

    /**
     * Display the user's submission history.
     */
    public function history()
    {
        $submissions = WritingSubmission::where('user_id', Auth::id())
            ->with('prompt')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('writing.history', ['submissions' => $submissions]);
    }
}