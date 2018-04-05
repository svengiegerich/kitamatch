<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class CriteriumController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function show($proid) {
        $provider = Criterium::where('proid', '=', $proid)->get();
        //no criteria found
        if (length($provider)<1) {
            $this->add($proid);
            return();
        }
        
        //criteria found
        //->edit
    }
    
    public function add($proid) {
        
    }
    
    public function edit($proid) {
        
    }
}
