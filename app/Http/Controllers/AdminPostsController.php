<?php

namespace App\Http\Controllers;

use App\Post;
use App\Photo;
use App\Comment;
use App\Category;
use App\CommentReply;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(2);
        return view('admin.posts.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id')->all();
        return view('admin.posts.create', [
            'categories' => $categories,
        ]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = new Post();

        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->category_id = $request->input('category_id');
        $post->user_id = Auth::user()->id;

        if($request->hasFile('photo')){
            
            $image = $request->photo->store('images', 'public');
            $photo = new Photo();
            $photo->file = $image;
            $photo->save();

            $post->photo_id = $photo->id;    
        }

        $post->save();
        $request->session()->flash('status', 'Post was created successfuly!');

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        if(Auth::user()->id == $post->user_id){

            $categories = Category::pluck('name', 'id')->all();

            return view('admin.posts.edit', [
                'post' => $post,
                'categories' => $categories,
            ]);
        } else {

            $request->session()->flash('error', 'you are not authorized');

            return redirect(route('posts.index'));
        }
        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->category_id = $request->input('category_id');
        if($request->hasFile('photo')){
            if($post->photo_id){
                $photo = Photo::findOrFail($post->photo_id);
                Storage::disk('public')->delete($photo->file);
                $image = $request->photo->store('images', 'public');
                $photo->file = $image;
                $photo->save();
            } else {
                $image = $request->photo->store('images', 'public');
                $photo = new Photo();
                $photo->file = $image;
                $photo->save();

                $post->photo_id = $photo->id;    
            }
            
        }
        
        
        $post->save();
        $request->session()->flash('status', 'Post was updated successfuly!');

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if(Auth::user()->id == $post->user_id){
            if($post->photo_id){
                $photo = Photo::findOrFail($post->photo_id);
                Storage::disk('public')->delete($photo->file);
    
                $photo->delete();
            }

            $post->delete();
            Alert::success('Delete!', 'Post deleted successfuly!');
            return redirect(route('posts.index'));
        }
        else {

            //$request->session()->flash('error', 'You are not autorise');
            Alert::error('Error!', 'you are not authorized');


            return redirect(route('posts.index'));
        }
    }
}
