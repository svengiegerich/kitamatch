<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Program extends Model
{
    //
	
    public function isCoordinated($pid) {
        $res = DB::table('programs')->select('coordination')
            ->where('pid', '=', $pid)
            ->get()
            ->first;
        print_r($res);
        return $res->coordination;
    }
    
    public $primaryKey = 'pid';
    public $timestamps = false;
}
