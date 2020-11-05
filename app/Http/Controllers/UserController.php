<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function incCoffeeCounter(Request $request)
    {
        $user = auth()->user();
        
        $user->coffee_counter += $request->inc_number;
        $user->save();

        return response()->json([
            'message' => 'Coffee counter successfully incremented',
            'new_coffee_counter' => $user->coffee_counter
        ], 200);
    }

    public function decCoffeeCounter(Request $request)
    {
        $user = auth()->user();
        
        $new_coffee_counter = $user->coffee_counter - $request->dec_number;
        if ($new_coffee_counter < 0) {
            $new_coffee_counter = 0;
        }

        $user->coffee_counter = $new_coffee_counter;
        $user->save();

        return response()->json([
            'message' => 'Coffee counter successfully decremented',
            'new_coffee_counter' => $user->coffee_counter
        ], 200);
    }

    public function fetchAuthUser(Request $request)
    {
        return auth()->user();
    }

    public function fetchAllUser(Request $request)
    {
        return User::all();
    }

    public function fetchCurrentCoffeeCounter(Request $request)
    {
        $coffee_counter = auth()->user()->coffee_counter;
        $user_created_at = auth()->user()->created_at;

        return response()->json([
            'coffee_counter' => $coffee_counter,
            'user_created_at' => $user_created_at,
        ], 200);
    }
}
