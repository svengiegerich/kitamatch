<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Preference extends Model
{
    //pr_kind: 1:applicant, 2:program coordinated, 3:program uncoordinated, 4: applicant uncoordinated
    
    public function updateStatus($prid, $status) {
        $exec = DB::table('preferences')
            ->where('prid', '=', $prid);
            ->update(array('status' => $status));
    }
    
    public private resetUncoordinated() {
        $nonactive = DB::table('preferences')
            ->where('pr_kind', '>=', '3');
            ->update(array('status' => -1));
    }
    
    public $primaryKey = 'prid';
    public $timestamps = false;
}
