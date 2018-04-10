<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
        
        //no criteria found, duplicate default criteria
        if (!($criteria->first())) {
            $request = new Request();
            $request->setMethod('POST');
            $request->request->add(['store_type' => 1,
                                   'provider_id' => $proid,
                                   'program' => 0]);
            $this->store($request);
            
            $criteria = Criterium::where('provider_id', '=', $proid)
                ->orderBy('rank', 'asc')
                ->get();
        }
        
        return view('criterium.edit', array('criteria' => $criteria));
    }
    
    public function showByProgram($programId) {
        $criteria = Criterium::where('provider_id', '=', $programId)
            ->where('program', '=', 1)
            ->orderBy('rank', 'asc')
            ->get(); 
        
        //no criteria found, duplicate default criteria
        if (!($criteria->first())) {
            $request = new Request();
            $request->setMethod('POST');
            $request->request->add(['store_type' => 1,
                                   'provider_id' => $programId,
                                   'program' => 1]);
            $this->storeByProgram($request);
            
            $criteria = Criterium::where('provider_id', '=', $programId)
                ->where('program', '=', 1)
                ->orderBy('rank', 'asc')
                ->get();
        }
        
        return view('criterium.edit', array('criteria' => $criteria));
    }
    
    public function edit($Request, $proid) {
        //tmp: edit
        
        return redirect()->action('CriteriumController@show', $proid);
    }
    
    public function store(Request $request) {
        
        //duplicate default criteria
        if ($request->store_type == 1) {
            $defaultCriteria = Criterium::where('provider_id', '=', -1)->get();
            foreach ($defaultCriteria as $defaultCriterium) {
                $criterium = new Criterium();
                $criterium->criterium_name = $defaultCriterium->criterium_name;
                $criterium->criterium_value = $defaultCriterium->criterium_value;
                $criterium->rank = $defaultCriterium->rank;
                $criterium->multiplier = $defaultCriterium->multiplier;
                $criterium->provider_id = $request->provider_id;
                $criterium->program = $request->program;
                $criterium->save();
            }
        }
    }
    
    private function storeByProgram(Request $request) {
        $request->request->add(['program' => 1]);
        $this->store($request);
    }
}
