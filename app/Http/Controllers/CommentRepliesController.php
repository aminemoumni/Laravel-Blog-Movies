<?php

namespace App\Http\Controllers;

use App\CommentReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CommentRepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $reply = new CommentReply();
        $reply->comment_id = $request->input('comment_id');
        $reply->body = $request->input('body');
        $reply->author = Auth::user()->name;
        $reply->email = Auth::user()->email; 
        $reply->photo_id = Auth::user()->photo_id; 

        $reply->save();
        Alert::success('Thank you', 'Your reply is submitted and waiting for moderation');
        
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
        $replies = CommentReply::orderBy('created_at', 'DESC')->where('comment_id', $id)->get();
        // $comment = Comment::findOrFail($id);
        // $replies = $comment->replies;
        return view('admin.comments.replies.index', [
            'replies' => $replies,
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
        $reply = CommentReply::findOrFail($id);
        $reply->delete();
        
        
        
        return redirect()->back();
    
    }

    public function approve($id)
    {
        $reply = CommentReply::findOrFail($id);
        
        $reply->is_active = 1;
        $reply->save();

        return redirect()->back();
    }

    public function unapprove($id)
    {
        $reply = CommentReply::findOrFail($id);
        
        $reply->is_active = 0;
        $reply->save();
        return redirect()->back();
    }


}
