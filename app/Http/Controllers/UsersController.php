<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function index()
    {
        $users = DB::select('
            SELECT
                id,
                name,
                last_name,
                email,
                email_verified_at,
                created_at,
                updated_at
            FROM users'
        );

        if(request()->wantsJson()) {
            return response(compact('users'), 200);
        }

        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::where('id', $id)->with('addresses')->firstOrFail();

        return response(compact('user'), 200);
    }
}
