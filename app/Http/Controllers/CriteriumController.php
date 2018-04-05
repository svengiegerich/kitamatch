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
        echo $proid;
        /*$criteria = Criterium::where('provider_id', '=', $proid)
            ->orderBy('rank', 'asc')
            ->get();
        //no criteria found
        if (length($criteria)<1) {
            $this->add($proid);
        }
        
        //criteria found
        return view('criterium.edit', array('criteria' => $criteria));*/
    }
    
    public function add($proid) {
        
    }
    
    public function edit($proid) {
        
    }
}
