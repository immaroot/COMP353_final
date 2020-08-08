<?php

namespace App\Http\Controllers\Employer;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function show()
    {
        Auth::guard('employer')->check();
        $user = Auth::guard('employer')->user();

        $job_posts = $user->company()->job_posts()->get();
        $isAdmin = $user->isAdmin();

        return view('employer.dashboard', ['job_posts' => $job_posts, 'isAdmin' => $isAdmin]);
    }
}
