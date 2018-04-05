<?php namespace App\Traits;

use Illuminate\Support\Facades\DB;

use App\Criterium;

trait GetPreferences
{
    //get all preferences of an applicant
    public function getPreferencesByApplicant($aid) {
        /*$preferences = DB::table('preferences')->where('id_from', '=', $aid)
                            ->whereIn('pr_kind', [1, 4])
                            ->where('status', '=', 1)
                            ->orderBy('rank', 'asc')
                            ->get();*/
        $sql = "SELECT * FROM preferences WHERE (`id_from` = " . $aid . " AND `status` = 1 AND (`pr_kind` = 1 OR `pr_kind` = 4)) ORDER BY rank asc, RAND()";
        $preferences = DB::select($sql);
        return $preferences;
    }
    
    //get all preferences of an program
    public function getPreferencesByProgram($pid) {
        /*$preferences = DB::table('preferences')->where('id_from', '=', $pid)
                            ->where('status', '=', 1)
                            ->where('pr_kind', '=', 2)
                            ->orderBy('rank', 'asc')
                            ->get();*/
        $sql = "SELECT * FROM preferences WHERE (`id_from` = " . $pid . " AND `status` = 1 AND `pr_kind` = 2) ORDER BY rank asc, RAND()";
        $preferences = DB::select($sql);
        return $preferences;
    }
    
    //get all preferences of an uncoordinated program
    public function getPreferencesUncoordinatedByProgram($pid) {
        /*$preferences = DB::table('preferences')->where('id_from', '=', $pid)
                            ->whereIn('status', [1, -1])
                            ->where('pr_kind', '=', 3)
                            ->orderBy('rank', 'asc')
                            ->get();*/
        //tmp: issue if all offers with rank = 1 and so ordered by time 
        $sql = "SELECT * FROM preferences WHERE (`id_from` = " . $pid . " AND (`status` = 1 OR `status` = -1) AND `pr_kind` = 3) ORDER BY rank asc, RAND()";
        $preferences = DB::select($sql);
        $this->orderByCriteria($preferences, 1);
        return $preferences;
    }
    
    public function getNonActivePreferencesByProgram() {
        $sql = "SELECT ANY_VALUE(`id_from`),ANY_VALUE(`pr_kind`),ANY_VALUE(`updated_at`),ANY_VALUE(`updated_at`),ANY_VALUE(`status`) FROM preferences WHERE (pr_kind = 2 OR OR pr_kind = 3) AND DATE(updated_at) < DATE_SUB(CURDATE(), INTERVAL 7 DAY) GROUP BY id_from";
        $preferences = DB::select($sql);
        return $preferences;
    }
    
    private function orderByCriteria($preferences, $providerId) {
        $criteria = Criterium::where('provider_id', '=', $providerId)
            ->orderBy('rank', 'asc')
            ->get();
        
        foreach($preferences as $preference) {
            $preference->points = 0;
            foreach($criteria as $criterium) {
                $criterium_name = (string)$criterium->criterium_name;
                echo $preference->{$criterium_name};
                echo " ";
                /*if ($criterium->criterium_value == $preference->{$criterium_name}) {
                    $preference->points = $preference->points + $criterium->multiplier;
                }*/
            }
            echo "<br>new: ";
            echo $preference->points;
        }
    }
}