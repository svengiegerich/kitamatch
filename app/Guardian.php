<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Guardian extends Model
{
    //
    
    public $primaryKey = 'gid';
    
    public function getGuardianByUid($uid) {
        $guardian = Guardian::where('uid', '=', $uid)->firstOrFail();
        print_r($guardian);
        return $guardian;
    }
}
