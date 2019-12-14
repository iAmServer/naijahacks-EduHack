<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'course_id', 'url', 'title',
    ];
    public function course(){
        return $this->belongsTo('App\Course');
    }
}
