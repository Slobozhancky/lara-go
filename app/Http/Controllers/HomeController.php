<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {

        $title = 'Home page';
        $test = 'some info';
        return view('home', ['title' => $title]);
    }
}
