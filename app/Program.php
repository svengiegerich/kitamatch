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
    
    public $primaryKey = 'pid';
    public $timestamps = false;
}
