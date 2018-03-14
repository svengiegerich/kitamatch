<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Program;

class ProgramController extends Controller
{
    public function index() {
        //return view('program.index');
    }
    
    public function store(Request $request) {
        //Validation
        
        $program = new Program;
        $program->name = $request->name;
        $program->adress = $request->adress;
        
        $program->save();
    }
    
    public function show($aid) {
        $program = Program::find($pid);
        //return view('program.show', array('program' => $program));
    }
    
    public function all() {
        $programs = Program::all();
        //return view('program.all', array('programs' => $programs));
    }
    
    public function edit($aid) {
        //
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
