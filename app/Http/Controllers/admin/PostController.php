<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\post;
use App\Models\tag;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = Post::with('user','tags')->orderBy('id', 'asc')->get();
        return view('admin.post.view', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags=tag::all();
        return view('admin.post.add',compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Step 1: Validate Request
        $validated = $request->validate([
            'title'   => 'required',
            'content' => 'required',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Step 2: Handle Image Upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Get file extension
            $extension = $request->file('image')->getClientOriginalExtension();

            // Generate random name (example: 65321_2025-09-16.jpg)
            $randomName = rand(10000, 99999) . '_' . date('Y-m-d') . '.' . $extension;

            // Store in storage/app/public/posts with custom name
            $imagePath = $request->file('image')->storeAs('posts', $randomName, 'public');
        }

        // Step 3: Create Post
        $post = new Post();
        $post->title   = $validated['title'];
        $post->content = $validated['content'];
        $post->image   = $imagePath;
        $post->user_id = Auth::id(); // logged-in user ka id

        $post->save(); 

        if ($request->has('tags')) {
            $post->tags()->attach($request->tags);
        }


        // Step 4: Redirect
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        $tags = Tag::all();
        return view('admin.post.update', compact('post','tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title'   => 'required',
            'content' => 'required',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $post = Post::findOrFail($id);

        // Agar nayi image aayi ho
        if ($request->hasFile('image')) {
            // Purani image delete karein agar exist karti ho
            if ($post->image && file_exists(storage_path('app/public/' . $post->image))) {
                unlink(storage_path('app/public/' . $post->image));
            }

            $extension = $request->file('image')->getClientOriginalExtension();
            $randomName = rand(10000, 99999) . '_' . date('Y-m-d') . '.' . $extension;

            $imagePath = $request->file('image')->storeAs('posts', $randomName, 'public');
            $post->image = $imagePath;
        }

        $post->title   = $validated['title'];
        $post->content = $validated['content'];

        // Sync tags (remove old and add new)
        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->detach();
        }

        $post->save();

        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        // Purani image delete
        if ($post->image && file_exists(storage_path('app/public/' . $post->image))) {
            unlink(storage_path('app/public/' . $post->image));
        }

        $post->delete();

        return redirect()->route('post.index');
    }
}
