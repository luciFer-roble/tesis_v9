<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Image;
use Intervention\Image\File;
use Laracasts\Flash\Flash;

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
        if($user->avatar!='user.jpg'){
            $oldavatar=public_path('/uploads/avatars/'.$user->avatar);
            unlink($oldavatar);
        }

        $nameimage = $id.'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save(public_path('/uploads/avatars/'.$nameimage));

        User::updateOrCreate(['id'  => $id], [
            'avatar'      => $nameimage
        ]);

        Flash::success('Actualizado Correctamente');
        return back();
    }


    public function destroy($id)
    {
        //
    }
}
