<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getUserDetails()
    {
        $user = auth()->user();

        $user = User::find($user['id'])->first();
        
        if ($user['country'] === null) {
            $user['country'] = 'No country selected';
        }

        return response()->json([
            'name' => $user['name'],
            'country' => $user['country']
        ]);
    }

    public function getCountriesList()
    {
        $countriesList = config('countriesList');
        
        return response()->json([
            'list' => $countriesList
        ]);
    }

    public function updateStreamingCountry(Request $request)
    {
        $user = auth()->user();

        $country['id'] = $request->id;
        $country['name'] = $request->name;

        $user = User::find($user['id']);
        $user->country = $country['id'];
        $user->save();
        
        return response()->json([
            'message' => 'Streaming country updated',
            'country' => $country['name']
        ]);
    }
}