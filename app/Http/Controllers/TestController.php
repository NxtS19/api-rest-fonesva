<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Demand;

class TestController extends Controller
{
    public function testORM(){
        $demands = Demand::all();
        foreach ($demands as $demand){
            echo "<h1>".$demand->reference."</h1>";
        }
        die();
    }
}
