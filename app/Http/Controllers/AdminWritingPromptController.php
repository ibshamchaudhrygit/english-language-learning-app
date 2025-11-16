<?php

namespace App\Http\Controllers;

use App\Models\WritingPrompt;
use Illuminate\Http\Request;

class AdminWritingPromptController extends Controller
{
    public function index()
    {
        $prompts = WritingPrompt::all();
        return view('admin.prompts.index', ['prompts' => $prompts]);
    }

    public function create()
    {
        return view('admin.prompts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'prompt' => 'required|string',
            'skill_level' => 'required|in:beginner,intermediate,advanced',
        ]);
        WritingPrompt::create($data);
        return redirect('/admin/prompts')->with('success', 'Prompt created successfully.');
    }

    public function edit(WritingPrompt $prompt)
    {
        return view('admin.prompts.edit', ['prompt' => $prompt]);
    }

    public function update(Request $request, WritingPrompt $prompt)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'prompt' => 'required|string',
            'skill_level' => 'required|in:beginner,intermediate,advanced',
        ]);
        $prompt->update($data);
        return redirect('/admin/prompts')->with('success', 'Prompt updated successfully.');
    }

    public function destroy(WritingPrompt $prompt)
    {
        $prompt->delete();
        return redirect('/admin/prompts')->with('success', 'Prompt deleted successfully.');
    }
}