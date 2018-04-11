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
    
    public function show($p_id) {
        $criteria = Criterium::where('p_id', '=', $p_id)
            ->orderBy('rank', 'asc')
            ->get();
        
        //no criteria found, duplicate default criteria
        if (!($criteria->first())) {
            $request = new Request();
            $request->setMethod('POST');
            $request->request->add(['store_type' => 1,
                                   'p_id' => $p_id,
                                   'program' => 0]);
            $this->store($request);
            
            $criteria = Criterium::where('p_id', '=', $p_id)
                ->orderBy('rank', 'asc')
                ->get();
        }
        
        return view('criterium.edit', array('criteria' => $criteria));
    }
    
    public function showByProgram($programId) {
        $criteria = Criterium::where('p_id', '=', $programId)
            ->where('program', '=', 1)
            ->orderBy('rank', 'asc')
            ->get(); 
        
        //no criteria found, duplicate default criteria
        if (!($criteria->first())) {
            $request = new Request();
            $request->setMethod('POST');
            $request->request->add(['store_type' => 1,
                                   'p_id' => $programId,
                                   'program' => 1]);
            $this->storeByProgram($request);
            
            $criteria = Criterium::where('p_id', '=', $programId)
                ->where('program', '=', 1)
                ->orderBy('rank', 'asc')
                ->get();
        }
        
        return view('criterium.edit', array('criteria' => $criteria));
    }
    
    public function editAjax(Request $request, $p_id) {
        $criteriaIds = $request->all();
        /*$orderList = [];
        $i = 1;*/
        //https://laracasts.com/discuss/channels/laravel/sortable-list-with-change-in-database
        
        parse_str($request->order, $criteria);
        $test = [];
        $i = 1;
        foreach ($criteria['item'] as $index => $criteriumId) {
            $criterium = Criterium::find($criteriumId);
            $criterium->rank = $index;
            $criterium->save();
            $i = $i + 1;
            $test[] = $criterium;
        }
        
        /*foreach ($criteriaIds as $certiumId) {
            $orderList[$certiumId->va] = $i;
            $i = $i + 1;
        }*/
        /*
        $oldOrderCriteria = Criterium::where('p_id', '=', $p_id)->get();
        foreach ($oldOrderCriteria as $criterium) {
            $requestC = new Request();
            $requestC->setMethod('POST');
            $requestC->request->add(['cid' => $criterum->cid,
                                   'rank' => $orderList[$criterum->cid]]);
            $this->edit($requestC);
            
        }*/
        
        return response()->json([
                    'success' => true,
                    'data'   => $criteria['item']
            ]); 
        
        //return redirect()->action('CriteriumController@show', $p_id);
    }
    
    public function store(Request $request) {
        
        //duplicate default criteria
        if ($request->store_type == 1) {
            $defaultCriteria = Criterium::where('p_id', '=', -1)->get();
            foreach ($defaultCriteria as $defaultCriterium) {
                $criterium = new Criterium();
                $criterium->criterium_name = $defaultCriterium->criterium_name;
                $criterium->criterium_value = $defaultCriterium->criterium_value;
                $criterium->rank = $defaultCriterium->rank;
                $criterium->multiplier = $defaultCriterium->multiplier;
                $criterium->p_id = $request->p_id;
                $criterium->program = $request->program;
                $criterium->save();
            }
        }
    }
    
    public function edit(Request $request) {
        $criterium = Criterium::find($request->cid);
        if ($request->criterium_name) { $criterium->criterium_name = $request->criterium_name; }
        if ($request->criterium_value) { $criterium->criterium_value = $request->criterium_value; }
        if ($request->rank) { $criterium->rank = $request->rank; }
        if ($request->multiplier) { $criterium->multiplier = $request->multiplier; }
        if ($request->p_id) { $criterium->p_id = $request->p_id; }
        if ($request->program) { $criterium->program = $request->program; }
        $criterium->save();
        return $criterium;
    }
                                    
    private function storeByProgram(Request $request) {
        $request->request->add(['program' => 1]);
        $this->store($request);
    }
}
