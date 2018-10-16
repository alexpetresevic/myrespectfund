<?php

namespace App\Http\Controllers\Admin;

use App\Campaign;
use App\FuneralHome;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $users        = User::count();
        $campaigns    = Campaign::count();
        $partners     = FuneralHome::whereNotNull('user_id')->count();
        $funeralHomes = FuneralHome::count();
        $posts        = Post::count();

        return view('admin.dashboard', compact('users', 'campaigns', 'partners', 'funeralHomes', 'posts'));
    }
}
