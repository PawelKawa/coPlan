<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        return inertia('Index/index',
    [
        //go to web dev vue and index chech attribute it will be there this message
        'message' => "Hi from laravel, yo"
    ]);
    }


    public function second(){
        return inertia('Index/second');
    }
}
