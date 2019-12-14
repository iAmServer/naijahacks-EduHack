<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name', 'user_id', 'keyword', 'description', 'work', 'salary'
    ];
    public function savedSearches(){
        return $this->hasMany('App\SavedSearch');
    }
    public function subCourses(){
        return $this->hasMany('App\SubCourse');
    }
    public function courseOffereds(){
        return $this->hasMany('App\CourseOffered');
    }
    public function admissions(){
        return $this->hasMany('App\Admission');
    }
    public function experts(){
        return $this->hasMany('App\Expert');
    }
    public function trainings(){
        return $this->hasMany('App\Training');
    }
    public function communityEngagements(){
        return $this->hasMany('App\CommunityEngagement');
    }
    public function video(){
        return $this->hasMany('App\Video');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
