<?php

namespace App\Http\Controllers;

use App\Models\SpeakingPhrase;
use Illuminate\Http\Request;

class AdminSpeakingPhraseController extends Controller
{
    public function index()
    {
        $phrases = SpeakingPhrase::all();
        return view('admin.phrases.index', ['phrases' => $phrases]);
    }

    public function create()
    {
        return view('admin.phrases.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'phrase' => 'required|string',
            'skill_level' => 'required|in:beginner,intermediate,advanced',
            'category' => 'required|string|max:100',
        ]);
        SpeakingPhrase::create($data);
        return redirect('/admin/phrases')->with('success', 'Phrase created successfully.');
    }

    public function edit(SpeakingPhrase $phrase)
    {
        return view('admin.phrases.edit', ['phrase' => $phrase]);
    }

    public function update(Request $request, SpeakingPhrase $phrase)
    {
        $data = $request->validate([
            'phrase' => 'required|string',
            'skill_level' => 'required|in:beginner,intermediate,advanced',
            'category' => 'required|string|max:100',
        ]);
        $phrase->update($data);
        return redirect('/admin/phrases')->with('success', 'Phrase updated successfully.');
    }

    public function destroy(SpeakingPhrase $phrase)
    {
        $phrase->delete();
        return redirect('/admin/phrases')->with('success', 'Phrase deleted successfully.');
    }
}