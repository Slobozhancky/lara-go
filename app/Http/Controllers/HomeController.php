<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function index() : string
    {

        if( !View::exists('home')){
            abort(404);
        }

        $title = 'Home page';
        $test = 'some info';
        return view('home', compact('title', 'test'));
    }
}
