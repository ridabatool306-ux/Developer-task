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
        if (Auth::check()) {
            $user = Auth::user();

            // Role-based filtering
            if ($user->role === 'admin' || $user->role === 'editor') {
                // Admin and Editor can see all posts
                $post = post::with('user', 'tags', 'comments.user', 'comments.replies.user')->get();
                // return view('admin.index',compact('post'));
            } else {
                // Normal user can see only their own posts
                $post = Post::with(['user', 'tags', 'comments.user', 'comments.replies.user'])
                    ->where('user_id', $user->id)
                    ->get();
            }
            return view('admin.index', [
                'post' => $post,
                'selected_comment_id' => $request->comment_id
            ]);
        } else {
            return redirect()->route('login');
        }
    }
}
