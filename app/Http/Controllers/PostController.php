<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Str;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all();
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories', Category::all())
                                   ->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'featured_img' => 'required|image',
            'category_id' => 'required',
        ]);

        //store into db
        $featured = $request->featured_img;
        $featured_new_name = time().$featured->getClientOriginalName();
        $post->move('uploads/products/',$featured_new_name);
        // Storage::disk('public')->put($featured_new_name, file_get_contents($featured));

        $user_id = Auth::id();

        //Mass Assignment
        $post = Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'featured_image' => 'uploads/products/'.$featured_new_name,
            'category_id' => $request->category_id,
            'user_id' => $user_id
        ]);

        $post->tags()->attach($request->tags);

        Session::flash('success', 'Post Created Successfully');


        return redirect()->route('post.index');

    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show')->with('post', $post)
                                 ->with('tags', Tag::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('post', $post)
                                   ->with('categories', Category::all())
                                   ->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        // $this->validate($request,[
        //     'title' => 'required',
        //     'description' => 'required',
        // ]);

        //update into db
        if($request->hasFile('featured_img')){
            $featured = $request->featured_img;
            $featured_new_name = time().$featured->getClientOriginalName();
            $featured->move('uploads/products/', $featured_new_name);
            $post->featured_image = 'uploads/products/'.$featured_new_name;
            $post->save();
            // Storage::disk('public')->put($featured_new_name, file_get_contents($featured));
            // $post->featured_image = $featured_new_name;
        }

        // $post->title = $request->title;
        // $post->description = $request->description;
        // $post->save();

        $post->fill($request->input())->save();

        $post->tags()->sync($request->tags);

        Session::flash('success', 'Post Updated Successfully');

        //return redirect
        return redirect()->route('post.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        // Storage::disk('public')->delete($post->featured_image);

        Session::flash('success', 'Post Trashed Successfully');
        return redirect()->route('post.index');
    }

    public function trashed(){

        $posts = Post::onlyTrashed()->get();
        return view('posts.trashed')->with('posts', $posts);
    
    }

    public function restore($id){

        $post = Post::withTrashed()->where('id', $id)->first();
        $post->restore();
        
        Session::flash('success', 'Post Restored Successully');
        return redirect()->route('post.index');

    }

    public function kill($id){

        $post = Post::withTrashed()->where('id', $id)->first();
        $post->forceDelete();

        Session::flash('success', 'Post Deleted Successfully');
        return redirect()->route('post.index');

    }

}
