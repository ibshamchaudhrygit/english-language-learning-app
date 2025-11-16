<?php

namespace App\Http\Controllers;

use App\Models\LiveSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LiveSessionController extends Controller
{
    /**
     * Display a listing of upcoming sessions for students.
     */
    public function index()
    {
        $sessions = LiveSession::where('start_time', '>=', now())
            ->with('user') // Eager load the teacher
            ->orderBy('start_time', 'asc')
            ->get();
            
        return view('sessions.index', ['sessions' => $sessions]);
    }

    /**
     * Show the teacher's session management page.
     */
    public function manage()
    {
        $sessions = LiveSession::where('user_id', Auth::id())
            ->orderBy('start_time', 'desc')
            ->get();
            
        return view('teacher.sessions.index', ['sessions' => $sessions]);
    }

    /**
     * Show the form for creating a new session.
     */
    public function create()
    {
        return view('teacher.sessions.create');
    }

    /**
     * Store a newly created session in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'meeting_url' => 'required|url',
            'start_time' => 'required|date|after:now',
        ]);

        Auth::user()->liveSessions()->create($data);

        return redirect('/teacher/sessions')->with('success', 'Live session scheduled!');
    }


    /**
     * Show the form for editing the specified session.
     */
    public function edit(LiveSession $session)
    {
        // Policy check
        if ($session->user_id !== Auth::id()) {
            abort(403);
        }
        return view('teacher.sessions.edit', ['session' => $session]);
    }

    /**
     * Update the specified session in storage.
     */
    public function update(Request $request, LiveSession $session)
    {
        // Policy check
        if ($session->user_id !== Auth::id()) {
            abort(403);
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'meeting_url' => 'required|url',
            'start_time' => 'required|date',
        ]);

        $session->update($data);

        return redirect('/teacher/sessions')->with('success', 'Live session updated!');
    }

    /**
     * Remove the specified session from storage.
     */
    public function destroy(LiveSession $session)
    {
        // Policy check
        if ($session->user_id !== Auth::id()) {
            abort(403);
        }

        $session->delete();
        return redirect('/teacher/sessions')->with('success', 'Live session canceled.');
    }
}