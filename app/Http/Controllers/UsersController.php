<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function index()
    {
        $users = DB::select('
            SELECT
                id,
                CONCAT(name,
                \' \',
                last_name) AS fullname,
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
        $user = User::where('id', $id)->with(['addresses' => function($query) {
            $query->select('id', 'address_1', 'address_2', 'zipcode', 'city', 'state', 'country', 'addresses.created_at', 'addresses.updated_at');
        }])->firstOrFail();

        return response(compact('user'), 200);
    }
}
