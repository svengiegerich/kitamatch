<?php namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait GetPreferences
{
    //get all preferences of an applicant
    public function getPreferencesByApplicant($aid) {
        $preferences = DB::table('preferences')->where('id_from', '=', $aid)
                            ->whereIn('pr_kind', [1, 4])
                            ->where('status', '=', 1)
                            ->orderBy('rank', 'asc')
                            ->get();
        return $preferences;
    }
    
    //get all preferences of an program
    public function getPreferencesByProgram($pid) {
        $preferences = DB::table('preferences')->where('id_from', '=', $pid)
                            ->where('status', '=', 1)
                            ->where('pr_kind', '=', 2)
                            ->orderBy('rank', 'asc')
                            ->get();
        return $preferences;
    }
    
    //get all preferences of an uncoordinated program
    public function getPreferencesUncoordinatedByProgram($pid) {
        $preferences = DB::table('preferences')->where('id_from', '=', $pid)
                            ->whereIn('status', [1, -1])
                            ->where('pr_kind', '=', 3)
                            ->orderBy('rank', 'asc')
                            ->get();
        return $preferences;
    }
}