<?php

namespace App\Http\Controllers\World;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorldController extends Controller
{
    public function cities ()
    {
        $title = 'Cities page';

        $cities = (City::query()->limit(50)->get())->filter(function ($city, $key){
            return $city['Population'] > 1_000_000;
        });

        return view('world.cities' , compact('cities' , 'title'));
    }

    public function countries ()
    {
        $title = 'Countries page';

        $countries = Country::query()
            ->where('population', ">", "200000")
            ->orderBy('Population', 'desc')
            ->get(['Name','Code', 'Population', 'Region']);

        return view('world.countries' , compact('countries' , 'title'));
    }
}
