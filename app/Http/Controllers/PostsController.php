<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Role;
use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Posts::latest()->with('users')->get();
        $roles = Role::with('users')->get();
        return view('posts.index', compact('posts', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //        Validate
        $request->validate([
            'title'=>['required','max:100'],
            'content1'=>['max:100'],
            'picture'=>['required']
        ]);

        $post = new Posts;

        $post->title = $request->title;
        $post->content = $request->content1;
        $post->picture = $request->picture;
        $post->created_by = Auth::user()->id;
        $post->save();

        return redirect(route('posts'))->with('status', 'Post Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function show(Posts $posts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Posts  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Posts $post)
    {
        //
        return view('posts.edit',compact('post'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Posts  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Posts $post)
    {
        // For some reason using the word 'content' was breaking my code...
        $request->validate([
            'title'=>['required','max:100'],
            'content1'=>['max:100'],
            'picture'=>['required']
        ]);

        $post->title = $request->title;
        $post->content = $request->content1;
        $post->picture = $request->picture;
        $post->save();

        return redirect(route('posts'))->with('status', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Posts  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posts $post)
    {
        //
        $post->delete();
        $post->deleted_by = Auth::id();
        $post->save();

        return redirect(route('posts'))->with('status', 'Post Deleted');
    }
}
