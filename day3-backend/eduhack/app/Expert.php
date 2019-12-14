<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    protected $fillable = [
        'course_id', 'name', 'url',
    ];
    public function course(){
        return $this->belongsTo('App\Course');
    }
}
