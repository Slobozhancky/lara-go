<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
//        $max_populations = DB::table('country')->max('population');
//        $country = DB::table('country')->where('population', '=', $max_populations)->get();
        $count = DB::table('city')->count('ID');
        dump($count);

        $title = 'Home page';
//        return view('home.index', compact('users', 'title'));
    }

    public function contacts()
    {
        $title = 'Contacts page';
        return view('home.contacts', ['title' => $title]);
    }
}
