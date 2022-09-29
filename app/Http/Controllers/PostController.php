<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Photo;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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
        $posts = Post::search()
            ->when(Auth::user()->isAuthor(), fn($q)=>$q->where('user_id', Auth::id()))
            ->when(request()->trash,fn($q)=>$q->onlyTrashed())
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
        $links = [
            "posts" => route('post.index'),
            "create post" => route('post.create')
        ];
        return view('post.create', compact('links'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        //save post
        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description, 50, " ...");
        $post->user_id = Auth::id();
        $post->category_id = $request->category;
     
        //save feature image
        if($request->hasFile('feature_image')) {
         $newName = uniqid()."_feature_image.".$request->file('feature_image')->extension();
         $request->file('feature_image')->storeAs('public', $newName);
         $post->feature_image = $newName;
       }
       $post->save();

       //save photos
       if(isset($request->photos)){
            $savedPhoto = [];
            foreach($request->photos as $key=>$photo) {
                //save photo local
                $newName = uniqid()."_post.".$photo->extension();
                $photo->storeAs('public', $newName);
                
                //save photo db
                $savedPhoto[$key] = [
                    "post_id" => $post->id,
                    "name" => $newName
                ];
        }

        //for a lot of queries
        Photo::insert($savedPhoto);

        //for simple query
        // $photo = new Photo();
        // $photo->name = $newName;
        // $photo->post_id = $post->id;
        // $photo->save();

       }
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
        Gate::authorize('view', $post);
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
        $links = [
            "posts" => route('post.index'),
            "edit post" => route('post.create')
        ];
        Gate::authorize('update', $post);
        return view('post.edit', compact('post', 'links'));
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
        Gate::authorize('update', $post);

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

       foreach($request->photos as $photo) {
        //save photo local
        $newName = uniqid()."_post.".$photo->extension();
        $photo->storeAs('public', $newName);
      
        //save photo db
        $photo = new Photo();
        $photo->name = $newName;
        $photo->post_id = $post->id;
        $photo->save();

        }

       Alert::toast('Post is updated Successfully!', 'success');
       return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $post = Post::withTrashed()->findOrFail($id);
        Gate::authorize('delete', $post);

        if(request('delete') === 'force')
        {
            if($post->feature_image) {
                Storage::delete('public/'.$post->feature_image);
            }
    
            // foreach($post->photos as $photo){
            //     Storage::delete("public/".$photo->name);
            //     $photo->delete();
            // }
    
            Storage::delete($post->photos->map(fn($photo)=> "public/".$photo->name)->toArray());
            Photo::where('post_id', $post->id)->delete();
         
            Post::withTrashed()->findOrFail($id)->forceDelete();
            Alert::toast('Post is deleted Successfully!', 'success');
        }  
        elseif(request('delete') === 'restore')
        {

            Post::withTrashed()->findOrFail($id)->restore();
            Alert::toast('Post is restored Successfully!', 'success');
        }
        else
        {            
            Post::withTrashed()->findOrFail($id)->delete();
            Alert::toast('Post is moved to Trash Successfully!', 'success');
        }
       
        return redirect()->route('post.index');
    }
}
