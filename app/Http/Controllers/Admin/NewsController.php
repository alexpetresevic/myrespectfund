<?php

namespace App\Http\Controllers\Admin;

use App\News;
use App\File as FileModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::paginate(10);

        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|min:3|max:255',
            'body'  => 'required',
            'file' => 'sometimes|image'
        ]);

        $news = new News();

        $news->title = $data['title'];
        $news->body  = $data['body'];

        $news->save();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = uniqid('press_') . '.' . $file->getClientOriginalExtension();
            $path = public_path('/uploads/press');

            $uploaded = $file->move($path, $filename);


            $image = new FileModel();
            $image->filename = $uploaded->getFilename();
            $image->image_url = $uploaded->getPathname();
            $image->file()->associate($news);
            $image->save();
        }

        return redirect()->route('admin.news.index')->with('status', ['type' => 'success', 'message' => 'News created successfully.']);
    }

    public function show(News $news)
    {
        abort(404);
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $data = $request->validate([
            'title' => 'required|min:3|max:255',
            'body'  => 'required',
        ]);

        $news->title = $data['title'];
        $news->body  = $data['body'];

        $news->update();

        if ($request->hasFile('file')) {
            $news->image()->delete();

            $file = $request->file('file');
            $filename = uniqid('press_') . '.' . $file->getClientOriginalExtension();
            $path = public_path('/uploads/press');

            $uploaded = $file->move($path, $filename);


            $image = new FileModel();
            $image->filename = $uploaded->getFilename();
            $image->image_url = $uploaded->getPathname();
            $image->file()->associate($news);
            $image->save();
        }

        return redirect()->route('admin.news.index')->with('status', ['type' => 'success', 'message' => 'News updated successfully.']);
    }

    public function destroy(News $news)
    {
        abort(404);
    }
}
