<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FinderItemsController extends Controller
{
    public function showItems(Request $request)
    {
        return inertia('Finder');
    }
}
