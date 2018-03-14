<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Matching extends Model
{
    
    public function resetMatchings() {
        //temp: set all current matchings on active=0 before the new results
        //future: only update "new" or "different" matches and not all
        
        $nonactive = DB::table('matchings')->update(array('active' => 0));
    }
    
    public $primaryKey = 'mid';
}
