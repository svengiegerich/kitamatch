<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MatchingConfig extends Model
{

    public function updateConfig($config_name, $value){
        $exec = DB::table('matching_configs')
        ->where('config_name', 'like', $config_name)
        ->update(array(
            'value' => $value, 
            'updated_at' => now()
        ));
    }
    //
    public $primaryKey = 'mcid';
    protected $table = 'matching_configs';
}
