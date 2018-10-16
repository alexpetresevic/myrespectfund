<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Post;
use App\Testimonial;

class HomeController extends Controller
{

    public function index()
    {
        $campaigns    = Campaign::where('private', 0)->latest()->limit(6)->get();
        $posts        = Post::where('published', true)->latest()->limit(2)->get();
        $testimonials = Testimonial::latest()->limit(6)->get();

        return view('home', compact('campaigns', 'posts', 'testimonials'));
    }
}
