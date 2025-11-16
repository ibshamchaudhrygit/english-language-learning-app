<?php

namespace App\Http\Controllers;

use App\Models\SpeakingPhrase;
use Illuminate\Http\Request;

class SpeakingPracticeController extends Controller
{
    /**
     * Display the speaking practice page.
     */
    public function index()
    {
        // Group phrases by category for the view
        $groupedPhrases = SpeakingPhrase::orderBy('skill_level')
            ->get()
            ->groupBy('category');
            
        return view('speaking.index', ['groupedPhrases' => $groupedPhrases]);
    }
}