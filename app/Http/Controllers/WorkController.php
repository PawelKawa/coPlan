<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorkController extends Controller
{
    public function work(Request $request)
    {
        return inertia('Work');
    }
}
