<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all()->pluck('email');

        if(request()->wantsJson()) {
            return response($users, 200);
        }

        return view('users.index', compact('users'));
    }

    public function show($email)
    {
        $user = User::where('email', $email)->with('addresses')->firstOrFail();

        return response($user, 200);
    }
}
