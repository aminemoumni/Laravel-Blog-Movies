<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::paginate(3);
        $categories = Category::all();
        return view('front.home', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }
    public function post($slug){

        $post = Post::findBySlugOrFail($slug);
        $comments = $post->comments()->orderBy('created_at', 'DESC')->whereisActive(1)->get();
        $categories = Category::all();
        
        return view('post', [
            'post' => $post,
            'categories' => $categories,
            'comments' => $comments,
        ]);
    }
    public function postByCategory($id){
        $posts = Post::where('category_id', $id)->paginate(3);
        $categories = Category::all();
        return view('front.home', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }
}
