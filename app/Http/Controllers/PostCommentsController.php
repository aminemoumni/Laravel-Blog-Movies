<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PostCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::orderBy('created_at', 'DESC')->get();
        return view('admin.comments.index', [
            'comments' => $comments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = new Comment();
        $comment->post_id = $request->input('post_id');
        $comment->body = $request->input('body');
        $comment->author = Auth::user()->name;
        $comment->email = Auth::user()->email; 
        $comment->photo_id = Auth::user()->photo_id; 

        $comment->save();
        Alert::success('Thank you', 'Your comment is submitted and waiting for moderation');
        
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comments = Comment::orderBy('created_at', 'DESC')->where('post_id', $id)->get();
        // $post = Post::findOrFail($id);
        // $comments = $post->comments;
        return view('admin.comments.index', [
            'comments' => $comments,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        Alert::success('Delete!', 'Comment and the replies deleted successfuly!');
        return redirect()->back();
    }

    public function unapprove($id)
    {
        $comment = Comment::findOrFail($id);
        
        $comment->is_active = 0;
        $comment->save();

        return redirect()->back();
    }
    public function approve($id)
    {
        $comment = Comment::findOrFail($id);
        
        $comment->is_active = 1;
        $comment->save();

        return redirect()->back();
    }
}
