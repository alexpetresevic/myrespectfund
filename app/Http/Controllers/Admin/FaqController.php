<?php

namespace App\Http\Controllers\Admin;

use App\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::all();

        return view('admin.faq.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'question' => 'required|min:4|max:255',
            'answer'   => 'required',
        ]);


        $faq           = new Faq();
        $faq->question = $data['question'];
        $faq->answer   = $data['answer'];

        $faq->save();

        return redirect()->route('admin.faq.index')->with('status', ['type' => 'success', 'message' => 'FAQ created successfully.']);
    }

    public function show($id)
    {
        abort(404);
    }

    public function edit(Faq $faq)
    {
        return view('admin.faq.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $data = $request->validate([
            'question' => 'required|min:4|max:255',
            'answer'   => 'required',
        ]);

        $faq->question = $data['question'];
        $faq->answer   = $data['answer'];

        $faq->update();

        return redirect()->route('admin.faq.index')->with('status', ['type' => 'success', 'message' => 'FAQ updated successfully']);
    }

    public function destroy($id)
    {
        abort(404);
    }
}
