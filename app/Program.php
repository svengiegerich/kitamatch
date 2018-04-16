<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Program extends Model
{
    //

    public function getAll() {
        return (Program::whereIn('status', [12, 13])->orderBy('name', 'asc')->get());
    }

    public function isCoordinated($pid) {
        $res = Program::find($pid);
        return $res->coordination;
    }

    public function getCoordinated() {
        $programs = Program::where('coordination', '=', 1)->get();
        return $programs;
    }

    public function getProviderId($pid) {
        $program = Program::where('pid', '=', $pid)->first();
        return $program->proid;
    }

    public function getProgramByUid($uid) {
        $program = Program::where('uid', '=', $uid)->firstOrFail();
        return $program;
    }

    public function getProgramsByProid($proid) {
        $programs = Program::where('proid', '=', $proid)->get();
        return $programs;
    }

		protected $dates = [
				'created_at',
				'updated_at',
				'deleted_at',
				//
				'birthday'
		];

    public $primaryKey = 'pid';


}
