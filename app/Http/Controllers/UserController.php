<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\File as FileModel;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        $user = $request->user();
        return view('user.profile', compact('user'));
    }
    
    public function update(Request $request)
    {
        $user = $request->user();
        
        $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email|unique:users,email,' . $user->id,
            'password'   => 'sometimes|confirmed'
        ]);
        
        $user->first_name = $request->first_name;
        $user->last_name= $request->last_name;
        $user->email= $request->email;
        
        if (isset($request->password)) {
            $user->password = bcrypt($request->password);
        }
    
        $user->update();
        request()->session()->flash('message', 'Your account changes have been saved!');
        return redirect()->route('user.profile', ['id' => $user->id]);
    }
    
    public function uploadPicture(Request $request, User $user)
    {
        $messages = [
            'image.max' => 'Image size can\'t be greater than 5.5MB'
        ];
        
        $request->validate([
            'image' => 'required|image|max:5500',
        ], $messages);
        
        $file = $request->file('image');
        $filename = uniqid('cam_') . '.' . $file->getClientOriginalExtension();
        $path = public_path('/uploads/users');
    
        $uploaded = $file->move($path, $filename);
    
        if (is_null($user->image)) {
            $image = new FileModel();
            $image->filename = $uploaded->getFilename();
            $image->image_url = $uploaded->getPathname();
            $image->file()->associate($user);
            $image->save();
        }else {
            unlink($path . '/' . $user->image->filename);
            $user->image->filename = $uploaded->getFilename();
            $user->image->image_url = $uploaded->getPathname();
            $user->image->update();
        }
    }
    
    public function deletePicture(User $user)
    {
        $user->image->delete();
    }
}
