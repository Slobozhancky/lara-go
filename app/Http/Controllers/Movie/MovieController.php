<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Models\Movie\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function movie(){
        $movies = Movie::query()->find(1);

        foreach($movies->actors as $actor){
            echo $actor->name . '<br>';
        }
    }
}
