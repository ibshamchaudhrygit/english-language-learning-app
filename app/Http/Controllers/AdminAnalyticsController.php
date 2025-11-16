<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAnalyticsController extends Controller
{
    /**
     * Display site-wide analytics.
     */
    public "index"()
    {
        // For now, just load the view.
        return view('admin.analytics.index');
    }
}