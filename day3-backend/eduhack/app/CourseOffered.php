<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseOffered extends Model
{
    protected $fillable = [
        'course_id', 'school_id',
    ];
    public function course(){
        return $this->belongsTo('App\Course');
    }
    public function school(){
        return $this->belongsTo('App\School');
    }
}
