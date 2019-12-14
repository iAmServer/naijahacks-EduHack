<?php

namespace App\Http\Controllers;

use App\Admission;
use App\CommunityEngagement;
use App\Course;
use App\CourseOffered;
use App\Expert;
use App\SavedSearch;
use App\School;
use App\SubCourse;
use App\TestOption;
use App\TestQuestion;
use App\TestResult;
use App\Training;
use App\Video;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function courses()
    {
        $courses = Course::all();
        return response()->json($courses, 200);
    }
    
    public function course($id)
    {
        $course = Course::find($id);
        $subCourse = SubCourse::where('course_id', $course->id)->get();
        $admission = Admission::where('course_id', $course->id)->get();
        $training = Training::where('course_id', $course->id)->get();
        $video = Video::where('course_id', $course->id)->get();
        $expert = Expert::where('course_id', $course->id)->get();
        $communityEngagement = CommunityEngagement::where('course_id', $course->id)->get();
        $coursesOffered = CourseOffered::where('course_id', $course->id)->get();
        foreach($coursesOffered as $courseOffered){
            $school = $courseOffered->school->get();
        }
        return response()->json([
            'course' => $course, 
            'subCourse' => $subCourse, 
            'admission' => $admission, 
            'training' => $training, 
            'video' => $video, 
            'expert' => $expert, 
            'communityEngagement' => $communityEngagement,
            'school' => $school
        ], 200);
    }

    public function testQuestion()
    { 
        $questions = TestQuestion::all();
        $options = testOption::all();
        return response()->json([
            'questions' => $questions, 
            'options' => $options
        ], 200);
    }

    public function savedSearch(Request $request)
    { 
        $savedSearches = SavedSearch::where('user_id', 1)->get();
        foreach ($savedSearches as $course) {
            $courses = $course->course->get();
        }
        return response()->json([
            'savedSearches' => $courses
        ], 200);
    }

    
    public function saveCourse(Request $request)
    {   
        $save = SavedSearch::create($request->all());
        return response()->json($save, 201);
    }

    public function search(Request $request)
    { 
        $searches = Course::where('name', 'like',  '%'.$request->search.'%')->orWhere('keyword', 'like',  '%'.$request->search.'%')->orWhere('description', 'like',  '%'.$request->search.'%')
        ->orWhere('work', 'like',  '%'.$request->search.'%')->get();
        if($searches->count() > 0){
            return response()->json([
                'searches' => $searches
            ], 200);
        }else{
            return response()->json([
                'searches' => 'No search found'
            ], 200);
        }
    }
    
    public function createCourse(Request $request)
    {   
        $course = Course::create([
            'name' => $request->course_name,
            'user_id' => 1,
            'keyword' => $request->course_keyword,
            'description' => $request->course_description,
            'work' => $request->course_work,
            'salary' => $request->course_salary,
        ]);
        $last_course = Course::orderBy('created_at', 'desc')->select('id')->first();

        if($request->subcourse_name != ''){
            $subCourse = SubCourse::create([
            'course_id' => $last_course->id,
            'name' => $request->subcourse_name,
            'description' => $request->subcourse_description,
            ]);
        }else{
            $subCourse = SubCourse::create([
            'course_id' => $last_course->id,
            'name' => '',
            'description' => '',
            ]);
        }

        if($request->admission_jamb != '' || $request->admission_olevel != ''){
            $admission = Admission::create([
            'course_id' => $last_course->id,
            'jamb' => $request->admission_jamb,
            'olevel' => $request->admission_olevel,
            'others' => $request->admission_others,
            ]);
        }else{
            $admission = Admission::create([
            'course_id' => $last_course->id,
            'jamb' => '',
            'olevel' => '',
            'others' => '',
            ]);
        }

        if($request->video_url != '' || $request->video_title != ''){
            $video = Video::create([
            'course_id' => $last_course->id,
            'url' => $request->video_url,
            'title' => $request->video_title,
            ]);
        }else{
            $video = Video::create([
            'course_id' => $last_course->id,
            'url' => '',
            'title' => '',
            ]);
        }

        if($request->training_name != '' || $request->training_cost != ''){
            $training = Training::create([
            'course_id' => $last_course->id,
            'name' => $request->training_name,
            'duration' => $request->training_duration,
            'cost' => $request->training_cost,
            ]);
        }else{
            $training = Training::create([
            'course_id' => $last_course->id,
            'name' => '',
            'duration' => '',
            'cost' => '',
            ]);

        }

        if($request->school_id != ''){
            $course_offered = CourseOffered::create([
            'course_id' => $last_course->id,
            'school_id' => $request->school_id,
            ]);
        }else{
            $course_offered = CourseOffered::create([
            'course_id' => $last_course->id,
            'school_id' => 3,
            ]);
        }

        if($request->expert_url != '' || $request->expert_name != ''){
            $expert = Expert::create([
            'course_id' => $last_course->id,
            'url' => $request->expert_url,
            'name' => $request->expert_name,
            ]);
        }else{
            $expert = Expert::create([
            'course_id' => $last_course->id,
            'url' => '',
            'name' => '',
            ]);
        }

        return response()->json([
            'message' => 'Course created successfully'
        ], 201);
    }

    public function updateCourse(Request $request, $id)
    {   
        $course = Course::find($id);
        $input = $request->all();
        $input['name'] = $request->course_name;
        $input['keyword'] = $request->course_keyword;
        $input['description'] = $request->course_description;
        $input['work'] = $request->course_work;
        $input['salary'] = $request->course_salary;

        $course->update($input);

        if($request->subcourse_name != ''){
            $subCourse = SubCourse::where('course_id', $id)->first();
            $input['name'] = $request->subcourse_name;
            $input['description'] = $request->subcourse_description;
            $subCourse->update($input);
        }

        if($request->admission_jamb != '' || $request->admission_olevel != ''){
            $admission = Admission::where('course_id', $id)->first();
            $input['jamb'] = $request->admission_jamb;
            $input['olevel'] = $request->admission_olevel;
            $input['others'] = $request->admission_others;
            $admission->update($input);
        }
        if($request->video_url != '' || $request->video_title != ''){
            $video = Video::where('course_id', $id)->first();
            $input['url'] = $request->video_url;
            $input['title'] = $request->video_title;
            $video->update($input);
        }
        if($request->training_name != '' || $request->training_cost != ''){
            $training = Training::where('course_id', $id)->first();
            $input['name'] = $request->training_name;
            $input['duration'] = $request->training_duration;
            $input['cost'] = $request->training_cost;
            $training->update($input);
        }

        if($request->expert_url != '' || $request->expert_name != ''){
            $expert = Expert::where('course_id', $id)->first();
            $input['url'] = $request->expert_url;
            $input['name'] = $request->expert_name;
            $expert->update($input);
        }
        return response()->json([
            'message' => 'Course information updated successfully'
        ], 200);
    }

    public function communityEngagement()
    {
        $communityEngagements = CommunityEngagement::all();
        return response()->json($communityEngagements, 200);
    }
}
