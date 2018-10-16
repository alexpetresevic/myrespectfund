<?php

namespace App\Http\Controllers\Admin;

use App\Toolkit;
use App\File as FileModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ToolkitController extends Controller
{
    public function index()
    {
        $items = Toolkit::all();

        return view('admin.toolkit.index', compact('items'));
    }

    public function create()
    {
        return view('admin.toolkit.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'body'  => 'required',
            'file'  => 'file|mimetypes:application/pdf,application/x-pdf',
        ]);

        $toolkit = Toolkit::create($data);

        $file     = $request->file('file');
        $filename = str_slug($toolkit->title) . $file->getClientOriginalExtension();
        $path     = public_path('/uploads/toolkits');

        $uploaded = $file->move($path, $filename);

        $image            = new FileModel();
        $image->filename  = $uploaded->getFilename();
        $image->image_url = $uploaded->getPathname();
        $image->file()->associate($toolkit);
        $image->save();

        return redirect()->route('admin.toolkit.index')->with('status', ['type' => 'success', 'message' => 'Item created successfully.']);

    }

    public function show($id)
    {
        abort(404);
    }

    public function edit(Toolkit $toolkit)
    {
        return view('admin.toolkit.edit', compact('toolkit'));
    }

    public function update(Request $request, Toolkit $toolkit)
    {
        $data = $request->validate([
            'title' => 'required',
            'body'  => 'required',
            'file'  => 'sometimes|file|mimetypes:application/pdf,application/x-pdf',
        ]);

        $toolkit->update($data);
        $toolkit = $toolkit->fresh();

        $file     = $request->file('file');
        $filename = str_slug($toolkit->title) . $file->getClientOriginalExtension();
        $path     = public_path('/uploads/toolkits');

        $uploaded = $file->move($path, $filename);

        $image            = new FileModel();
        $image->filename  = $uploaded->getFilename();
        $image->image_url = $uploaded->getPathname();
        $image->file()->associate($toolkit);
        $image->save();

        return redirect()->route('admin.toolkit.index')->with('status', ['type' => 'success', 'message' => 'Item updated successfully.']);
    }

    public function destroy($id)
    {
        //
    }
}
