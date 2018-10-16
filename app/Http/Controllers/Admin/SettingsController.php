<?php

namespace App\Http\Controllers\Admin;

use App\Services\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Settings::getInstance();

        return view('admin.settings.index', compact('settings'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $settings = Settings::getInstance();
        
        foreach ($request->get('settings') as $key => $value) {
            $settings->set($key, $value);
        }

        return redirect()->route('admin.settings.index')->with('status', ['type' => 'success', 'message' => 'Settings saved successfully.']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
