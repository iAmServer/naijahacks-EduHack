<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCourse extends Model
{
    protected $fillable = [
        'course_id', 'name', 'description',
    ];
    public function course(){
        return $this->belongsTo('App\Course');
    }
}
