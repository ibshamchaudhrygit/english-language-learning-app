<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of all users.
     */
    public function index()
    {
        // Fetch all users to display in the view
        $users = User::orderBy('name')->get();
        return view('admin.users.index', ['users' => $users]);
    }

    // You can add create, store, edit, update, destroy methods here later
}