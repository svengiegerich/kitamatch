<?php namespace App\Traits;

trait GetPreferences
{
    //get all preferences of an applicant
    public function getPreferencesByApplicant($aid) {
        $preferences = DB::table('preferences')->where('id_from', '=', $aid)
                            ->where('active', '=', 1)
                            ->where('pr_kind', '=', 1)
                            ->orderBy('rank', 'asc')
                            ->get();
        return $preferences;
    }
    
    //get all preferences of an program
    public function getPreferencesByProgram($pid) {
        $preferences = DB::table('preferences')->where('id_from', '=', $pid)
                            ->where('active', '=', 1)
                            ->where('pr_kind', '=', 2)
                            ->orderBy('rank', 'asc')
                            ->get();
        return $preferences;
    }
}