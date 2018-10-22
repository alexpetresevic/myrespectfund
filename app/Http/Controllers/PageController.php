<?php

namespace App\Http\Controllers;

use App\Faq;
use App\Mail\ContactForm;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function privacy()
    {
        $page = Page::where('slug', 'privacy-policy')->first();
        
        return view('page', compact('page'));
    }
    
    public function terms()
    {
        $page = Page::where('slug', 'terms-of-use')->first();
        
        return view('page', compact('page'));
    }
    
    public function partnership()
    {
        $page = Page::where('slug', 'partnership-program')->first();
        
        return view('page', compact('page'));
    }
    
    public function faq(Request $request)
    {
        $data = $request->validate([
            'q' => 'nullable|min:3',
        ]);
        
        if ($request->has('q')) {
            $items = Faq::where('question', 'LIKE', '%' . $data['q'] . '%')->orWhere('answer', 'LIKE', '%' . $data['q'] . '%')->get();
        }else {
//            $items = Faq::paginate(5);
            $items = Faq::all();
        }
        
        return view('page-faq', compact('items'));
    }
    
    public function howWeHelp()
    {
        $page = Page::where('slug', 'how-we-help')->first();
        
        return view('page', compact('page'));
    }
    
    // public function help()
    // {
    //     $page = Page::where('slug', 'help')->first();
        
    //     return view('page', compact('page'));
    // }
    
    public function checklist()
    {
        abort(404);
        $page = Page::where('slug', 'checklist')->first();
        
        return view('page', compact('page'));
    }
    
    public function fees()
    {
        abort(404);
        $page = Page::where('slug', 'fees')->first();
        
        return view('page', compact('page'));
    }
    
    public function contact()
    {
        return view('contact');
    }
    
    public function contactSubmit(Request $request)
    {
        $data = $request->validate([
            "name"    => 'required',
            "email"   => 'required|email',
            "subject" => 'required',
            "message" => 'required',
        ]);
        
        Mail::to('info@myrespects.com')->send(new ContactForm($data));
        
        return redirect()->back()->with('message', 'Contact form sent successfully.');
    }
    
    public function verifyCapcha(Request $request)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify?secret=' . env('GOOGLE_CAPCHA_SECRET') . '&response=' . $request->all()['g-recaptcha-response']);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);
        $capcha = json_decode($res);
        
        if ($capcha->success) {
            return response()->json([
                'valid'
            ], 200);
        }else{
            return response()->json([
                'error'
            ], 500);
        }
        
    }
}
