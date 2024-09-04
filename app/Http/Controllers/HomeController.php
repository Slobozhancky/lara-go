<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->get();

        dump($users);
        $title = 'Home page';
        return view('home.index', compact('users', 'title'));
    }

    public function contacts()
    {
        $title = 'Contacts page';
        return view('home.contacts', ['title' => $title]);
    }
}
