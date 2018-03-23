<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Preference extends Model
{
    //pr_kind: 1:applicant, 2:program coordinated, 3:program uncoordinated, 4: applicant uncoordinated
    
    public function updateStatus($prid, $status) {
        $exec = DB::table('preferences')
            ->where('prid', '=', $prid)
            ->update(array('status' => $status));
    }
    
    public function resetUncoordinated() {
        $nonactive = DB::table('preferences')
            ->whereIn('pr_kind', [3])
            ->update(array('status' => -1));
    }
    
    public function hasPreferencesByProgram($pid) {
        $preferenceProgram = Preference::where('id_from', '=', $pid)
            ->where('status', '>', 0)
            ->whereIn('pr_kind', [2, 3])
            ->first();
        //if not also create pref applicant sided
        if ($preferenceProgram === null) {
            return false;
        } else {
            return true;
        }
    }
    
    public function hasPreferencesByApplicant($aid) {
        $preferenceApplicant = Preference::where('id_from', '=', $aid)
            ->where('status', '>', 0)
            ->whereIn('pr_kind', [1, 4])
            ->first();
        //if not also create pref applicant sided
        if ($preferenceApplicant === null) {
            return 0;
        } else {
            return 1;
        }
    }
    
    public function getAvailableApplicants($pid) {
        $applicants = DB::table('preferences')
            ->join('applicants', 'applicants.aid', '=', 'preferences.id_from')
            ->where('preferences.id_to', '=', $pid)
            ->whereIn('preferences.pr_kind', [1,4])
            ->select('applicants.*')
            ->orderBy('preferences.status', 'desc')
            ->get();
        return $applicants;
    }
    
    public $primaryKey = 'prid';
    public $timestamps = false;
}
