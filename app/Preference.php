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
        /*
        SELECT applicants.* FROM preferences 
        INNER JOIN applicants ON applicants.aid = preferences.id_from
        WHERE preferences.id_to = 6
        WHERE IN preferences.pr_kind = (1,4)
        ORDER BY preferences.status
        */
        
        $applicants = DB::table('preferences')
            ->join('applicants', 'applicants.aid', '=', 'preferences.id_from')
            ->where('preferences.id_to', '=', $pid)
            //tmp: status?
            //tmp: 4 can be removed
            ->whereIn('preferences.pr_kind', [1,4])
            ->select('applicants.*')
            ->get();
        return $applicants;
    }
    
    public function orderByCriteria($applicants, $providerId) {
        $criteria = Criterium::where('provider_id', '=', $providerId)
            ->orderBy('rank', 'asc')
            ->get();
        
        foreach($applicants as $applicant) {
            $guardian = Guardian::find($applicant->gid);
            $applicants->points = 0;
            if ($guardian != null) {
                foreach($criteria as $criterium) {
                    $criterium_name = $criterium->criterium_name;
                    if ($criterium->criterium_value == $guardian->{$criterium_name}) {
                        $applicant->points = $applicant->points + $criterium->multiplier;
                    }
                }
                echo "<br>" . $applicant->points . "<br>";
            } else {
                echo "<br> no guardian <br>";
            }
        }
        
        //tmp: add geocoordinated way
        
        $applicants = $applicants->sortBy('points', true, true);
        return $applicants; 
    }
    
    public $primaryKey = 'prid';
}
