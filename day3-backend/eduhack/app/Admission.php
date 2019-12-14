<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    protected $fillable = [
        'course_id', 'jamb', 'olevel', 'others'
    ];
    public function course(){
        return $this->belongsTo('App\Course');
    }
}
