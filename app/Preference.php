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

    //$provider = true -> criteria from a provider level
    public function orderByCriteria($applicants, $p_Id, $provider) {
        if ($provider) {
            $criteria = Criterium::where('p_id', '=', $p_Id)
                ->orderBy('rank', 'asc')
                ->get();
        } else {
            //singel program
            $criteria = Criterium::where('p_id', '=', $p_Id)
                ->where('program', '=', 1)
                ->orderBy('rank', 'asc')
                ->get();
        }

        //tmp: if criteria is null, use the default order (indicated by providerId = -1)
        if ($criteria === null) {
            $criteria = Criterium::where('p_id', '=', -1)
            ->orderBy('rank', 'asc')
            ->get();
        }

        foreach($applicants as $applicant) {
            $guardian = Guardian::find($applicant->gid);

            $applicant->order = 0;
            if ($guardian != null) {
                foreach($criteria as $criterium) {
                    $criterium_name = $criterium->criterium_name;
                    if ($criterium->criterium_value == $guardian->{$criterium_name}) {
                        $applicant->order = $applicant->order + $criterium->rank * $criterium->multiplier;
                    }
                }
            } else {
                //no guardian -> order = 10000, to order asc
                $applicant->order = 1000;
            }

            //highly important applicants
            if ($applicant->status == 25) {
                $applicant->order = 0;
            }
        }
        //tmp: add geocoordinated way
        //sort by birthday on the same level
        //https://github.com/laravel/ideas/issues/11;
        $applicants = $applicants->sort(function($a, $b) {
            if($a->order === $b->order) {
                if($a->birthday === $b->birthday) {
                   return 0;
                 }
                return $a->birthday < $b->birthday ? 1 : -1;
            }
            return $a->order < $b->order ? 1 : -1;
        });
        return $applicants;
    }

    public $primaryKey = 'prid';
}
