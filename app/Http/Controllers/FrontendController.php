<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use App\Category;
use App\Post;
use App\Tag;
use Newsletter;
use Session;

class FrontendController extends Controller
{
    public function index(){
        $title = Setting::first()->site_name;
        return view('index')->with('title', $title)
                            ->with('settings', Setting::first())
                            ->with('categories', Category::take(5)->get())
                            ->with('first_post', Post::orderBy('created_at', 'desc')->first())
                            ->with('second_post', Post::orderBy('created_at', 'desc')->skip(1)->take(1)->get()->first())
                            ->with('third_post', Post::orderBy('created_at', 'desc')->skip(2)->take(1)->get()->first())
                            ->with('javascript', Category::find(17))
                            ->with('laravel', Category::find(18));
  
    }

    public function category(Category $category){
        
        return view('category')->with('category', $category)
                               ->with('title', $category->name)
                               ->with('settings', Setting::first())
                               ->with('categories', Category::take(5)->get());

    }

    public function single_post($slug){
        $post = Post::where('slug', $slug)->first();

        $next_id = Post::where('id', '>', $post->id)->min('id');
        $prev_id = Post::where('id', '<', $post->id)->max('id');

        return view('single')->with('post', $post)
                             ->with('title', $post->title)
                             ->with('settings', Setting::first())
                             ->with('categories', Category::take(5)->get())
                             ->with('tags', Tag::all())
                             ->with('next', Post::find($next_id))
                             ->with('prev', Post::find($prev_id));

    }

    public function search(){
        
        $posts = Post::where('title', 'like', '%'.request('query').'%')->get();

        return view('results')->with('posts', $posts)
                              ->with('title', 'Search results : '. request('query'))
                              ->with('query', request('query'))
                              ->with('settings', Setting::first())
                              ->with('categories', Category::take(5)->get());

    }

    public function subscribe(){
        
        $email = request('email');

        Newsletter::subscribe($email);

        Session::flash('success', 'Successfuly subscribed');
        return redirect()->back();
    }

    public function tag($id){
        
        $tag = Tag::find($id);

        return view('tag')->with('tag', $tag)
                        ->with('title', $tag->tag)
                        ->with('settings', Setting::first())
                        ->with('categories', Category::take(5)->get());

    }

    
}
