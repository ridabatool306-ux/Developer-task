<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if(Auth::check()){
            $post=post::with('user','tags','comments.user', 'comments.replies.user')->get();
            // return view('admin.index',compact('post'));
             return view('admin.index', [
                'post' => $post,
                'selected_comment_id' => $request->comment_id
            ]);
        }else{
            return redirect()->route('login');
        }
            
    }

}
