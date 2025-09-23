<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request){
        $data=$request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'role' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        // Handle Image Upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Get file extension
            $extension = $request->file('image')->getClientOriginalExtension();

            // Generate random name (example: 65321_2025-09-16.jpg)
            $randomName = rand(10000, 99999) . '.' . $extension;

            // Store in storage/app/public/posts with custom name
            $imagePath = $request->file('image')->storeAs('users', $randomName, 'public');
        }

        //Create Data
        $post = new User();
        $post->name   = $data['name'];
        $post->email = $data['email'];
        $post->password   = $data['password'];
        $post->role = $data['role'];
        $post->image = $imagePath;

        $post->save(); 
        return redirect()->route('login');
    }

    public function login(Request $request){
        $data1=$request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if(Auth::attempt($data1)){
            return redirect()->route('home');
        }
    }

    public function logout(){
        Auth::logout();
        return view('login');
    }
}
