<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    protected $fillable = [
        'user_id', 'keyword', 
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
}
