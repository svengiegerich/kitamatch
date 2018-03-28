<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Program extends Model
{
    //
	
    public function isCoordinated($pid) {
        $res = Program::find($pid);
        return $res->coordination;
    }
    
    public function getProgramByUid($uid) {
        $program = Program::where('uid', '=', $uid)->firstOrFail();
        return $program;
    }
    
    public function getProgramsByProid($proid) {
        $program = Program::where('proid', '=', $proid)->firstOrFail();
        return $program;
    }
    
    public $primaryKey = 'pid';
    public $timestamps = false;
}
