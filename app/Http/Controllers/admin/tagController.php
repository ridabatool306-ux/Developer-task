<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\tag;
use Illuminate\Http\Request;

class tagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = tag::all();
        return view('admin.tags.view', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tags.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:tags,name'
        ]);
        Tag::create(['name' => $request->name]);

        return redirect()->route('tag.index');
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
        $tag = tag::findOrFail($id);
        return view('admin.tags.update', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tag = Tag::findOrFail($id);
        $request->validate([
            'name' => 'required|unique:tags,name,' . $tag->id
        ]);

        $tag->update(['name' => $request->name]);

        return redirect()->route('tag.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        tag::findOrFail($id)->delete();

        return redirect()->route('tag.index');
    }
}
