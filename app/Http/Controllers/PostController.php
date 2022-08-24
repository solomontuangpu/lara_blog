<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdatePostRequest;
use RealRashid\SweetAlert\Facades\Alert;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::when(request('keyword'), function($q) {
            $keyword = request('keyword');
            $q->where('title', 'like', "%$keyword%")
                ->orWhere('description', 'like', "%$keyword%");
        })
            ->latest('id')
            ->paginate(10)
            ->withQueryString();
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description, 50, " ...");
        $post->user_id = Auth::id();
        $post->category_id = $request->category;
       if($request->hasFile('feature_image')) {
         $newName = uniqid()."_feature_image.".$request->file('feature_image')->extension();
         $request->file('feature_image')->storeAs('public', $newName);
         $post->feature_image = $newName;
       }
       $post->save();
       Alert::toast('Post is created Successfully!', 'success');
       return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description, 50, " ...");
        $post->user_id = Auth::id();
        $post->category_id = $request->category;
       if($request->hasFile('feature_image')) {
            
            Storage::delete('public/'.$post->feature_image);

            $newName = uniqid()."_feature_image.".$request->file('feature_image')->extension();
            $request->file('feature_image')->storeAs('public', $newName);
            $post->feature_image = $newName;
       }
       $post->update();
       Alert::toast('Post is updated Successfully!', 'success');
       return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->feature_image) {
            Storage::delete($post->feature_image);
        }
        $post->delete();
        Alert::toast('Post is deleted Successfully!', 'success');
        return redirect()->route('post.index');
    }
}
