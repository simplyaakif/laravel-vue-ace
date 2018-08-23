<?php

namespace App\Http\Controllers;
use App\Http\Resources\CoursesResource;
use App\Courses;
use Illuminate\Http\Request;

class CoursesController extends Controller
{

    public function index()
    {
        $courses = Courses::orderBy('id', 'desc')->paginate(30);
        return CoursesResource::collection($courses);
    }
    public function store(Request $request)
    {
        $courses = $request->isMethod('put') ? Courses::findOrFail($request->id) : new Courses;
        $courses->id = $request->input('id');
        $courses->course_name = $request->input('course_name');
        $courses->course_duration = $request->input('course_duration');
        $courses->course_fee = $request->input('course_fee');
        $courses->course_comments = $request->input('course_comments');
        
        if($courses->save()){
            return new CoursesResource($courses);
        }
    }

    public function show(Courses $courses)
    {

        $course = Courses::findOrFail($courses->id);
        return new CoursesResource($course);
    }

    public function destroy(Courses $courses)
    {
        $course = Courses::findOrFail($courses->id);
        if ($course->delete()){
            return new CoursesResource($course);
        }
    }
}
