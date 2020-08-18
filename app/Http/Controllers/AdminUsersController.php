<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Photo;
use Illuminate\Http\Request;

use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserUpdateRequest;
use RealRashid\SweetAlert\Facades\Alert;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        
        return view('admin.users.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id')->all();
        
        return view('admin.users.create', [
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User();

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role_id = $request->input('role_id');
        $user->is_active = $request->input('is_active');
        $user->password = Hash::make($request->input('password'));

        if($request->hasFile('photo')){
            $image = $request->photo->store('images', 'public');
            $photo = new Photo();
            $photo->file = $image;
            $photo->save();

            $user->photo_id = $photo->id;

            
            
        }

        $user->save();
        $request->session()->flash('status', 'User was created successfuly!');

        return redirect(route('users.index'));
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
        $user = User::findOrFail($id);
        $roles = Role::pluck('name', 'id')->all();
        return view('admin.users.edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role_id = $request->input('role_id');
        $user->is_active = $request->input('is_active');
        
        if(trim($request->input('password')) != '') {
            $user->password = Hash::make($request->input('password'));
        }

        if($request->hasFile('photo')){

            if($user->photo_id) {
                $photo = Photo::findOrFail($user->photo_id);
                Storage::disk('public')->delete($photo->file);
                $image = $request->photo->store('images', 'public');
                $photo->file = $image;
                $photo->save();
            }
            else {

                $image = $request->photo->store('images', 'public');
                $photo = new Photo();
                $photo->file = $image;
                $photo->save();

                $user->photo_id = $photo->id;

            }
            
            
        }
        
        $user->save();
        //Alert::success('Update!', 'User updated successfuly!');
        //toast('User was updated successfuly!','success');
        $request->session()->flash('status', 'User was updated successfuly!');

        return redirect(route('users.index'));

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if($user->photo_id){
            $photo = Photo::findOrFail($user->photo_id);
            Storage::disk('public')->delete($photo->file);

            $photo->delete();
        }
        $user->delete();

        Alert::success('Delete!', 'User  deleted successfuly!');
        

        return redirect(route('users.index'));
    }
}
