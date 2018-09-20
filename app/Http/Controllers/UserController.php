<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        return User::all();
    }
    public function show(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            abort(400, trans('messages.user.id.notFound'));
        }
        return $user;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required|unique:user',
            'email'    => 'required|unique:user',
            'password' => 'required|min:8',
            'type'     => 'required|numeric'
        ]);

        $user = (new User(array_only($request->all(), ["name", "email", "password", "type"])));
        $user->save();

        return User::find($user->id);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            abort(400, trans('messages.user.id.notFound'));
        }

        $this->validate($request, [
            'name'     => "required|unique:user,id,{$id}",
            'email'    => 'required|unique:user',
            'password' => 'required|min:8',
        ]);

        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = $request->password;
        $user->save();

        return User::find($user->id);
    }

    public function delete(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            abort(400, trans('messages.user.id.notFound'));
        }
        $user->delete();

        return response("", 200);
    }

}
