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
        return ["api_token" => (new User)->where("name", $request->name)->first()->api_token];
    }

    public function logout() {
        //
    }
}
