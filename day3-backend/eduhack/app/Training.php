<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $fillable = [
        'course_id', 'name', 'duration', 'cost',
    ];
    public function course(){
        return $this->belongsTo('App\Course');
    }
}
