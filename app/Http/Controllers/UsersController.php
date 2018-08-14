<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Image;
use Intervention\Image\File;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(User $user)
    {

        return view('users.show')->with('user', $user);

    }


    public function edit()
    {

    }

    public function update(Request $request, $id)
    {
        $rules = array(
            'foto'    => 'required|image'

        );
        $this->validate(request(), $rules);

        $image  =   $request->file('foto');

        $user=User::all()->where('id','=',$id)->first();
        $oldavatar=public_path('/uploads/avatars/'.$user->avatar);
        unlink($oldavatar);


        list($nameorigin)=explode('.',$user->avatar,2);
        $nameimage = $nameorigin.'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save(public_path('/uploads/avatars/'.$nameimage));

        User::updateOrCreate(['id'  => $id], [
            'avatar'      => $nameimage
        ]);

        return back();
    }


    public function destroy($id)
    {
        //
    }
}
