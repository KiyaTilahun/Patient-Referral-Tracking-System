<?php

namespace App\Http\Controllers;

use App\Models\Admin\Region;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    //

    public function index(){
      
     $regions=Region::all();

        return view('pages.register',compact('regions'));
    }

    
}
