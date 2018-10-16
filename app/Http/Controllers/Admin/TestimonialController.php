<?php

namespace App\Http\Controllers\Admin;

use App\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\File;

class TestimonialController extends Controller
{
    public function index()
    {
        $items = Testimonial::paginate(10);
        
        return view('admin.testimonial.index', compact('items'));
    }
    
    public function create()
    {
        return view('admin.testimonial.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            "body"          => "required",
            "campaign_name" => "required",
            "upload_image"  => "sometimes|image|max:5500",
        ]);
        
        $testimonial = new Testimonial();
        $testimonial->user_id = 0;
        $testimonial->campaign_id = 0;
        $testimonial->campaign_name = $request->campaign_name;
        $testimonial->body = $request->body;
        
        $testimonial->save();

        if ($request->hasFile('upload_image')) {
            $file = $request->file('upload_image');
            $filename = uniqid('testimonials_') . '.' . $file->getClientOriginalExtension();
            $path = public_path('/uploads/testimonials');
        
            $uploaded = $file->move($path, $filename);
        
            $image = new File();
        
            $image->filename = $uploaded->getFilename();
            $image->image_url = $uploaded->getPathname();
            $image->file()->associate($testimonial);
            $image->save();
        }        
        
        return redirect()->route('admin.testimonial.index')->with('status', ['type' => 'success', 'message' => 'Testimonial created successfully.']);
    }
    
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonial.edit', compact('testimonial'));
    }
    
    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            "body"          => "required",
            "campaign_name" => "sometimes",
            "upload_image"  => "sometimes|image|max:5500",
        ]);
        
        $testimonial->campaign_name = $request->campaign_name;
        $testimonial->body = $request->body;
        
        $testimonial->update();

        if ($request->hasFile('upload_image')) {
            $file = $request->file('upload_image');
            $filename = uniqid('testimonials_') . '.' . $file->getClientOriginalExtension();
            $path = public_path('/uploads/testimonials');
        
            $uploaded = $file->move($path, $filename);
        
            $image = new File();
        
            $image->filename = $uploaded->getFilename();
            $image->image_url = $uploaded->getPathname();
            $image->file()->associate($testimonial);
            $image->save();
        }            
        
        return redirect()->route('admin.testimonial.index')->with('status', ['type' => 'success', 'message' => 'Testimonial updated successfully.']);
    }

    public function deletePicture(Testimonial $testimonial)
    {
        $testimonial->image->delete();
    }    
    
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        
        return redirect()->route('admin.testimonial.index')->with('status', ['type' => 'success', 'message' => 'Testimonial deleted successfully.']);
    }
}
