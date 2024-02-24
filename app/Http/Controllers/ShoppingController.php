<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShoppingController extends Controller
{
    public function shopping(Request $request)
    {
        return inertia('Shopping');

    }
}
