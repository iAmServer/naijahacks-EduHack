<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommunityEngagement extends Model
{
    protected $fillable = [
        'course_id', 'expert_id', 'title', 'url'
    ];
    
    public function course(){
        return $this->belongsTo('App\Course');
    }
}
