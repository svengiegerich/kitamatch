<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    //
	
    public function isCoordinated($pid) {
        return DB::table('programs')->select('coordination')
            ->where('pid', '=', $pid);
            ->get();
    }
    
    public $primaryKey = 'pid';
    public $timestamps = false;
}
