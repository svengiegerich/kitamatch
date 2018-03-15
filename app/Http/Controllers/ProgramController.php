<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Program;

class ProgramController extends Controller
{
    public function index() {
        return redirect()->action('ProgramController@all');
    }
    
    public function add() {
        return view('program.add');
    }
    
    public function store(Request $request) {
        //Validation
        
        $program = new Program;
        $program->name = $request->name;
        $program->adress = $request->address;
        $program->status = $request->status;
        $program->coordination = $request->coordination;
        
        $program->save();
        
        return redirect()->action('ProgramController@all');
    }
    
    public function show($aid) {
        $program = Program::find($pid);
        //return view('program.show', array('program' => $program));
    }
    
    public function all() {
        $programs = Program::all();
        return view('program.all', array('programs' => $programs));
    }
    
    public function edit($aid) {
        //
    }
    
    public function delete(Request $request, $pid) {
        $program = program::find($pid);
        //temp: set active=0 instead of deleting
        $program->delete();
        return redirect()->action('ProgramController@all');
    }
    
    public function update($request) {
        $program = App\Program::find($request->pid);
        
        //...
        
        $program->save();
    }
	
	public function getCapacity($pid) {
		$program = Program::find($pid);
		return $program->capacity;
	}
}
