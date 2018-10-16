<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::where('published', true)->latest()->paginate(15);
        $categories = Category::all();
        $tags = Tag::all();

        return view('blog.index', compact('posts', 'categories', 'tags'));
    }

    public function show($slug)
    {
        $post = Post::where(['slug' => $slug, 'published' => true])->first();
        
        if (!$post) {
            abort(404);
        }

        return view('blog.show', compact('post'));
    }
    
    public function filter(Category $category)
    {
        $posts = $category->posts()->paginate(15);
        $categories = Category::all();
        $tags = Tag::all();
        
        return view('blog.index', compact('posts', 'categories', 'tags'));
    }
    
    public function filterByTag(Tag $tag)
    {
        $posts = $tag->posts()->paginate(15);
        $categories = Category::all();
        $tags = Tag::all();
        
        return view('blog.index', compact('posts', 'categories', 'tags'));
    }
}
