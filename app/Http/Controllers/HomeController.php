<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
//        $users = json_decode(file_get_contents("https://jsonplaceholder.typicode.com/users"));
        $users = Http::get("https://jsonplaceholder.typicode.com/users")->json();
        $title = 'Home page';
        return view('home.index', compact('users', 'title'));
    }

    public function contacts()
    {
        $title = 'Contacts page';
        return view('home.contacts', ['title' => $title]);
    }
}
