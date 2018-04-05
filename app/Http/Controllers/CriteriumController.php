<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

use App\Criterium;

class CriteriumController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function show($proid) {
        $criteria = Criterium::where('provider_id', '=', $proid)
            ->orderBy('rank', 'asc')
            ->get();
        //no criteria found
        if (!($criteria->first())) {
            $request = new Request();
            $request->request->add(['store_type' => 1]);
            $this->store($proid);
        }
        
        //criteria found
        return view('criterium.edit', array('criteria' => $criteria));
    }
    
    public function add($proid) {
        
    }
    
    public function store(Request $request) {
        //
        if ($request->store_type = 1) {
            $defaultCriteria = Criterium::where('provider_id', '=', -1);
            foreach ($defaultCriteria as $defaultCriterium) {
                $criterium = new Criterium();
                $criterium->criterium_name = $defaultCriterium->criterium_name;
                $criterium->criterium_value = $defaultCriterium->criterium_value;
                $criterium->rank = $defaultCriterium->rank;
                $criterium->multiplier = $defaultCriterium->multiplier;
                $criterium->provider_id = $request->proid;
                $criterium->save();
            }
        }
    }
    
    public function edit($proid) {
        
    }
}
