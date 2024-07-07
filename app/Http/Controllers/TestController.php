<?php

namespace App\Http\Controllers;

class TestController extends Controller
{
    public function index(){
        return view('test', ['title' => 'Title page'] );
    }
}
