<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\File;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        
        return view('admin.blog.posts.index', compact('posts'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        
        return view('admin.blog.posts.create', compact('categories', 'tags'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required',
            'body'         => 'required',
            'published'    => 'boolean',
            'upload_image' => 'sometimes|image|max:5500',
        ]);
        
        $post = new Post($request->all());
        $post->user_id = auth()->user()->id;
        $post->save();
        
        if ($request->hasFile('upload_image')) {
            $file = $request->file('upload_image');
            $filename = uniqid('posts_') . '.' . $file->getClientOriginalExtension();
            $path = public_path('/uploads/posts');
        
            $uploaded = $file->move($path, $filename);
        
            $image = new File();
        
            $image->filename = $uploaded->getFilename();
            $image->image_url = $uploaded->getPathname();
            $image->file()->associate($post);
            $image->save();
        }
        
        $post->categories()->sync($request->get('categories', []));
        $post->tags()->sync($request->get('tags', []));
        
        return redirect()->route('admin.blog.posts.index')->with('status', ['type' => 'success', 'message' => 'Post created successfully.']);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post $post
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        
        return view('admin.blog.posts.edit', compact('post', 'categories', 'tags'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Post                     $post
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'     => 'required',
            'body'      => 'required',
            'published' => 'boolean',
            'upload_image' => 'sometimes|image|max:5500',
        ]);
        
        $post->update($request->all());
    
        if ($request->hasFile('upload_image')) {
            $file = $request->file('upload_image');
            $filename = uniqid('posts_') . '.' . $file->getClientOriginalExtension();
            $path = public_path('/uploads/posts');
        
            $uploaded = $file->move($path, $filename);
        
            $image = new File();
        
            $image->filename = $uploaded->getFilename();
            $image->image_url = $uploaded->getPathname();
            $image->file()->associate($post);
            $image->save();
        }
        
        $post->categories()->sync($request->get('categories', []));
        $post->tags()->sync($request->get('tags', []));
        
        return redirect()->route('admin.blog.posts.index')->with('status', ['type' => 'success', 'message' => 'Post updated successfully.']);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        $post->delete();
        
        return redirect()->route('admin.blog.posts.index')->with('status', ['type' => 'success', 'message' => 'Post deleted successfully.']);
    }
    
    public function deletePicture(Post $post)
    {
        $post->image->delete();
    }
}
