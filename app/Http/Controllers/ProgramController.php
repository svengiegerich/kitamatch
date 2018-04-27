<?php
/*
 * This file is part of the KitaMatch app.
 *
 * (c) Sven Giegerich <sven.giegerich@mailbox.org>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 /*
 |--------------------------------------------------------------------------
 | Program Controller
 |--------------------------------------------------------------------------
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Requests\UpdateProgramRequest;
use App\Http\Controllers\Controller;
use App\Traits\GetPreferences;
use App\Program;
use App\Matching;
use App\Provider;
use App\User;
use App\Code;

/**
* This controller handles with programs: the creation of new and update of existing ones, status changes and activity check for uncoordinated.
*/
class ProgramController extends Controller
{
  /**
   * Create a new controller instance. Handles auth.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
  }

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
        $requestUser = new Request();
        $requestUser->setMethod('POST');
        //public: 1 -> account_type = 2, private: 2 -> account_type = 3
        if ($request->p_kind == 1) { $accountType = 2; } else if ($request->p_kind == 2) { $accountType = 3; }
        $requestUser->request->add([
            'email' => $request->email,
            //tmp: password
            'password' => app('App\Http\Controllers\Auth\RegisterController')->generateStrongPassword(),
            'account_type' => $accountType
        ]);
        $user = app('App\Http\Controllers\Auth\RegisterController')->store($requestUser);
        $request->request->add([
            'proid' => $proid,
            'uid' => $user->id
        ]);
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
        //set all valid as default
        $program->status = 12;
        $program->p_kind = $request->p_kind;
        $program->coordination = $request->coordination;
        if (!$request->coordination) { $program->coordination = 0; }
        if ($program->p_kind == 1) { $program->coordination = 1; }
        $program->address = $request->address;
        $program->plz = $request->plz;
        $program->city = $request->city;
        $program->phone = $request->phone;
        $program->save();
        //tmp
        $this->setValid($program->id);

        return $program;
    }

    public function show($pid) {
        $program = Program::find($pid);
        return view('program.edit', array('program' => $program));
    }

    public function all() {
        $programs = Program::all();
        foreach ($programs as $program) {
          $program->status_description = Code::where('code', '=', $program->status)->first()->value;;
          $program->coordination_description = ($program->coordination == 1) ? "true" : "false";
          $program->p_kind_description = ($program->p_kind == 1) ? "public" : "private";
        }
        return view('program.all', array('programs' => $programs));
    }

    public function edit(UpdateProgramRequest $request, $pid) {
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

    public function update(UpdateProgramRequest $request) {
        $program = Program::find($request->pid);
        $program->name = $request->name;
        $user = User::where('id', '=', $program->uid)->first();
        $program->coordination = $request->coordination;
        //p_kind = 1, so coordination needs to be 1
        if (!$request->coordination) { $program->coordination = 0; }
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
      //minus final matches
      $Matching = new Matching();
      $countFinalsMatches = count(Matching::where('pid', '=', $pid)
        ->where('status', '=', 32)
        ->get());
		  return ($program->capacity - $countFinalsMatches);
	  }

    public function setValid($pid) {
        Program::where('pid', '=', $pid)->update(array('status' => '12'));
    }

    public function setNonActive() {
      //set not inactive, if is not 1 week after coordiantion starts
      if (strtotime(config('constants.coordination_start_date'))
         < strtotime('+7 days')) {
        return;
      }
      $Program = new Program();
      $preferences =  DB::table('preferences')
                ->whereRaw('updated_at >= DATE_ADD(CURDATE(),INTERVAL -7 DAY)')
                ->whereIn('pr_kind',[2,3])
                ->get();
      //$sql = "SELECT * FROM preferences WHERE updated_at >= DATE_ADD(CURDATE(),INTERVAL -7 DAY);";
      //$preferences = DB::select($sql);;
      $programs = $Program->getAll();
      foreach ($programs as $program) {
        if ($preferences->contains('id_from', $program->pid)) {
          Program::where('pid', '=', $program->pid)->update(array('status' => '12'));
        } else {
          Program::where('pid', '=', $program->pid)->update(array('status' => '13'));
          //!Mail
        }
      }
    }

    public function activityCheck() {
        $nonActivePreferences = $this->getNonActivePreferencesByProgram();
        foreach ($nonActivePreferences as $preference) {
            $this->setNonActive($preference->ANY_VALUE(`id_from`));
            //check if capacity is not fullfilled
            //...
        }
    }
}
