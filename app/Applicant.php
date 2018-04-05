<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Applicant extends Model
{
    //
    
    public function getAppliantsByGid($gid) {
        $applicants = Applicant::where('gid', '=', $gid)->get();
        return $applicants;
    }
    
        
    public function getGuardianIdByApplicant($aid) {
        $guardian = Applicant::where('aid', '=', $aid)->get();
        return ($guardian->gid);
    }
    
    public $primaryKey = 'aid';
    public $timestamps = false;
}
