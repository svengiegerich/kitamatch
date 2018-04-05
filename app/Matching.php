<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Matching extends Model
{
    
    public function resetMatches() {
        //temp: set all current matches on status=33 before the new results
        //future: only update "new" or "different" matches and not all
        
        $nonactive = DB::table('matches')->update(array('status' => 33));
    }
    
    public $primaryKey = 'mid';
    protected $table = 'matches';
}
