<?php

namespace App\Http\Controllers;

use App\Models\comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'comment' => 'required|string'
        ]);

        $comment = comment::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
            'parent_id' => $request->parent_id ?? null,
            'comment' => $request->comment
        ]);

        // Redirect back with query so selected reply form stays open
        if ($request->parent_id) {
            return redirect()
                ->route('post.reply', [
                    'post' => $request->post_id,
                    'comment_id' => $request->parent_id
                ])
                ->with('success', 'Reply added successfully!');
        }

        return redirect()->back();
    }


}
