<?php

namespace App\Views\Composers;

use Illuminate\View\View;

class TestComposer
{
    public function compose(View $view){
        $view->with(['name' => 'Bob', 'surname' => 'Petrov', 'age' => 28]);
    }
}
