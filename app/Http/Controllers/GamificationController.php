<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class GamificationController extends Controller
{
    /**
     * Display the leaderboard.
     * Spec 4.B
     */
    public function leaderboard()
    {
        $topUsers = User::where('role', 'user')
                        ->orderBy('points', 'desc')
                        ->take(10)
                        ->get();

        return view('gamification.leaderboard', [
            'users' => $topUsers
        ]);
    }

    /**
     * Display the user's badges.
     * Spec 4.A
     */
    public function badges()
    {
        $user = auth()->user();
        $user->load('badges'); // Eager load badges
        
        return view('gamification.badges', [
            'badges' => $user->badges
        ]);
    }
}