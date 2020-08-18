<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::all();
        
        return view('media.index', [
            'photos' => $photos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('media.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $image = $request->file->store('images', 'public');
            $photo = new Photo();
            $photo->file = $image;
            $photo->save();
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
        
        $photo = Photo::findOrFail($id);
        
        if($photo->post) {
            Alert::error('Error!', 'Photo used on post');
        }
        else if($photo->user) {
            Alert::error('Error!', 'Photo used on user');
        }
        else {
            Storage::disk('public')->delete($photo->file);
            $photo->delete();
            Alert::success('Delete!', 'Photo deleted successfuly!');
        }
        
        return redirect(route('media.index'));
    }
    
    public function deletemedia(Request $request)
    {
       $photos = Photo::findOrFail($request->checkBoxArray);
        foreach($photos as $photo){
            if($photo->post){
                Alert::error('Error!', 'Photo used on post');
            }
            else if($photo->user) {
                Alert::error('Error!', 'Photo used on user');
            }
            else{
                Storage::disk('public')->delete($photo->file);
                $photo->delete();
            }
            
        }
        return redirect()->back();
    }
}
