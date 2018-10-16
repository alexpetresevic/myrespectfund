<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all();

        return view('admin.page.index', compact('pages'));
    }

    public function create()
    {
        abort(404);
    }

    public function store(Request $request)
    {
        abort(404);
    }

    public function show($id)
    {
        abort(404);
    }

    public function edit(Page $page)
    {
        return view('admin.page.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $data = $request->validate([
            'title' => 'required|min:4|max:255',
        ]);

        $page->title = $data['title'];
        $page->body  = $request->has('body') ? $request->get('body') : '';

        $page->update();

        $request->flash();

        return redirect()->route('admin.pages.index')->with('status', ['type' => 'success', 'message' => 'Page updated successfully.']);
    }

    public function destroy($id)
    {
        abort(404);
    }
}
