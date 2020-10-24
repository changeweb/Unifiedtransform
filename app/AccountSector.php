<?php

namespace App;

class AccountSector extends Model {
    
    protected $table    = 'account_sectors';
    protected $fillable = ['name', 'type', 'school_id', 'user_id'];
    
    public function school()
    {
        return $this -> belongsTo( 'App\School', 'school_id' );
    }
    
    public function user()
    {
        return $this -> belongsTo( 'App\User', 'user_id' );
    }
}
