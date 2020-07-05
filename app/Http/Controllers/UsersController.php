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
                u.id,
                u.name,
                u.last_name,
                u.email,
                CONCAT(a.address_1, " ", a.address_2) AS address,
                a.city,
                a.zipcode,
                u.created_at,
                u.updated_at, a.created_at, a.updated_at
            FROM users AS u
            JOIN address_user AS au
            ON u.id = au.user_id
            JOIN addresses AS a
            ON a.id = au.address_id'
        );

        $count = User::all()->count();

        if(request()->wantsJson()) {
            return response(compact('users', 'count'), 200);
        }

        return view('users.index', compact('users'));
    }

    public function show($email)
    {
        $user = User::where('email', $email)->with('addresses')->firstOrFail();

        return response($user, 200);
    }
}
