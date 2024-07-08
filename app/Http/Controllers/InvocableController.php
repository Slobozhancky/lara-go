<?php

namespace App\Http\Controllers;

class InvocableController
{

    public function __invoke ()
    {
        return "Return invoke action";
    }

}
