<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Provider extends Model
{
    //
    
    
    public function getProviderByUid($uid) {
        $provider = Provider::where('uid', '=', $uid)->firstOrFail();
        return $provider;
    }
    
    public $primaryKey = 'proid';
    protected $table = 'provider';
}
