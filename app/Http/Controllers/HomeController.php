<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $title = 'Home page';
        return view('home.index', ['title' => $title]);
    }

    public function contacts()
    {
        $title = 'Contacts page';
        return view('home.contacts', ['title' => $title]);
    }
}
