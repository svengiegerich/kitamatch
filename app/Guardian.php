<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Guardian extends Model
{
    //
    
    public $primaryKey = 'gid';
    
    public function getGuardianByUid($uid) {
        $guardian = Guardians::where('uid', '=', $uid)->firstOrFail();
        return $guardian;
    }
}
