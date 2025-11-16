<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PrivateMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class ChatController extends Controller
{
    /**
     * Show the list of users to chat with.
     */
    public function index()
    {
        $users = User::where('id', '!=', Auth::id())
                     ->where('role', 'user') // Only chat with other students
                     ->orderBy('name')
                     ->get();
        return view('chat.index', ['users' => $users]);
    }

    /**
     * Show the chat history with a specific user.
     */
    public function show(User $user)
    {
        $myId = Auth::id();
        $theirId = $user->id;

        // Mark messages as read
        PrivateMessage::where('sender_id', $theirId)
            ->where('receiver_id', $myId)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        // Get all messages between the two users
        $messages = PrivateMessage::where(function(Builder $query) use ($myId, $theirId) {
                $query->where('sender_id', $myId)->where('receiver_id', $theirId);
            })->orWhere(function(Builder $query) use ($myId, $theirId) {
                $query->where('sender_id', $theirId)->where('receiver_id', $myId);
            })
            ->orderBy('created_at', 'asc')
            ->get();
            
        return view('chat.show', [
            'recipient' => $user,
            'messages' => $messages
        ]);
    }

    /**
     * Store a new message.
     */
    public function store(Request $request, User $user)
    {
        $request->validate(['message' => 'required|string']);

        $message = PrivateMessage::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $user->id,
            'message' => $request->message,
        ]);

        return redirect()->back();
    }

    /**
     * API endpoint to fetch new messages (for polling).
     */
    public function fetch(User $user)
    {
        $myId = Auth::id();
        $theirId = $user->id;

        $newMessages = PrivateMessage::where('sender_id', $theirId)
            ->where('receiver_id', $myId)
            ->whereNull('read_at')
            ->get();
            
        // Mark as read
        if ($newMessages->isNotEmpty()) {
            PrivateMessage::whereIn('id', $newMessages->pluck('id'))
                ->update(['read_at' => now()]);
        }

        return response()->json(['messages' => $newMessages]);
    }
}