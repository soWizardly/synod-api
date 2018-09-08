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
            abort(400, 'Bad User ID');
        }
        return $user;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required|unique:user',
            'email'    => 'required|unique:user',
            'password' => 'required|min:8',
        ]);

        $user = (new User(array_only($request->all(), ["name", "email", "password"])));
        $user->save();

        return $user;
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            abort(400, "Invalid User ID");
        }

        $this->validate($request, [
            'name'     => 'required|unique:user',
            'email'    => 'required|unique:user',
            'password' => 'required|min:8',
        ]);

        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = $request->password;
        $user->save();

        return $user;
    }

    public function delete(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            abort(400, "Invalid User ID");
        }
        $user->delete();

        return response("", 200);
    }

}
