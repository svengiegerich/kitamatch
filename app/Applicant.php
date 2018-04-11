<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Applicant extends Model
{
    
    public function getAppliantsByGid($gid) {
        $applicants = Applicant::where('gid', '=', $gid)->get();
        return $applicants;
    }
        
    public function getGuardianIdByApplicant($aid) {
        $applicant = Applicant::where('aid', '=', $aid)->first();
        return $applicant->gid;
    }
    
    public function getAll() {
        //tmp: remove 1
        return (Applicant::whereIn('status', [1, 22, 25])->get());
    }
    
    public $primaryKey = 'aid';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        //
        'birthday'
    ];
    
}
