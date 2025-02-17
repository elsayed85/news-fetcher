<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function token(Request $request)
    {
        return response()->json([
            'token' => $request->user()->createToken('just-for-test')->plainTextToken
        ]);
    }
}
