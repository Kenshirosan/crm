<?php

namespace App\Http\Controllers;

use App\Address;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressesController extends Controller
{
    public function index()
    {
        return view('addresses.index');
    }

    public function store(Request $request)
    {
        $user = User::findOrFail($request['user_id']);
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'address_1' => 'required|string',
            'address_2' => 'nullable|string',
            'country.*' => 'required|exists:countries',
            'state.*' => 'required|exists:states',
            'city' => 'required|exists:cities,name',
            'zipcode' => 'required'
        ]);

        $address = Address::create([
            'user_id' => $request['user_id'],
            'address_1' => $request['address_1'],
            'address_2' => $request['address_2'],
            'country' => json_encode($request['country']),
            'state' => json_encode($request['state']),
            'city' => $request['city'],
            'zipcode' => $request['zipcode']
        ]);

        $address->user($user);

        return response(['message' => 'address added successfully for ' . $user->name], 200);
    }

    public function update(Request $request)
    {
        $user = User::findOrFail($request['user_id']);
        $address = Address::findOrFail($request['id']);

        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'address_1' => 'nullable|string',
            'address_2' => 'nullable|string',
            'country.*' => 'nullable|exists:countries',
            'state.*' => 'nullable|exists:states',
            'city' => 'nullable|exists:cities,name',
            'zipcode' => 'nullable'
        ]);

        $address->update($request->all());

        return response(['success' => 'address updated successfully for ' . $user, 'address' => $address->toArray()], 200);
    }

    public function getCountries()
    {
        $countries = DB::select('SELECT id, name, sortname FROM countries');

        return response($countries, 200);
    }

    public function getStates($id)
    {
        $states = DB::select('SELECT id, name FROM states WHERE country_id = ' . $id);

        return response($states, 200);
    }

    public function getCities($id)
    {
        $cities = DB::select('SELECT id, name FROM cities WHERE state_id = ' . $id);

        return response($cities, 200);
    }
}
