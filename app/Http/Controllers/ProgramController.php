<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Program;
use App\Provider;

class ProgramController extends Controller
{
    public function index() {
        return redirect()->action('ProgramController@all');
    }
    
    public function add($proid) {
        $provider = Provider::findOrFail($proid);
        return view('program.add', array('provider' => $provider));
    }
    
    //controller & view function
    public function create(Request $request, $proid) {
        //tmp: create a uid for the program
        $uid = -1;
        $request->request->add(['proid' => $proid,
                               'uid' => $uid]);
        $this->store($request);
        
        return redirect()->action('ProviderController@show', $proid);
    }
    
    public function store(Request $request) {
        //Validation
        
        $program = new Program;
        $program->uid = $request->uid;
        $program->proid = $request->proid;
        $program->name = $request->name;
        $program->address = $request->address;
        $program->capacity = $request->capacity;
        //tmp
        $program->status = 1;
        $program->p_kind = $request->kind;
        $program->coordination = $request->coordination;
        $program->address = $request->address;
        $program->plz = $request->plz;
        $program->city = $request->city;
        $program->phone = $request->phone;
        
        $program->save();
        return $program;
    }
    
    public function show($pid) {
        $program = Program::find($pid);
        return view('program.edit', array('program' => $program));
    }
    
    public function all() {
        $programs = Program::all();
        return view('program.all', array('programs' => $programs));
    }
    
    public function edit(Request $request, $pid) {
        $request->request->add(['pid' => $pid]);
        $program = $this->update($request);
        return view('program.edit', array('program' => $program));
    }
    
    public function delete(Request $request, $pid) {
        $program = program::find($pid);
        //temp: set active=0 instead of deleting
        $program->delete();
        return redirect()->action('ProgramController@all');
    }
    
    public function update(Request $request) {
        $program = Program::find($request->pid);
        $program->name = $request->name;
        $program->coordination = $request->coordination;
        //p_kind = 1, so coordination needs to be 1
        if ($program->p_kind == 1) { $program->coordination = 1; }
        $program->capacity = $request->capacity;
        $program->address = $request->address;
        $program->plz = $request->plz;
        $program->city = $request->city;
        $program->phone = $request->phone;
        $program->save();
        return $program;
    }
	
	public function getCapacity($pid) {
		$program = Program::find($pid);
		return $program->capacity;
	}
}
