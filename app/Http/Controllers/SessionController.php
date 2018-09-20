<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function login(Request $request) {

        $this->validate($request, [
            'name' => 'required|exists:user',
            'password' => 'required',
        ]);

        $user = (new User)->where("name", $request->name)->where("password", $request->password)->first();
        if (!$user) {
            abort(401, trans("login.fail"));
        }

        return ["api_token" => $user->apiToken];

    }

    public function logout() {
        //
    }
}
