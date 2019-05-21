<?php

namespace App\Http\Controllers;

use App\Course;
use App\Area;
use App\Nature;
use App\Term;
use App\Topic;
use App\TopicCourse;
use App\RequerimentCourse;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\PlanControler;

class CourseController extends Controller
{

    public function __construct(){

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $courses = Course::with(['area','nature','term','requeriments.course','topics'])->orderBy('name')->get();
        return  $courses;
    }

    public function requeriments()
    {
        //
        $courses = DB::table('courses')->select('id', 'name')->orderBy('name')->get();
        return  $courses;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $course = new Course;
        $course->code = $request->code;
        $course->name = $request->name;
        $area = Area::find($request->area);
        $nature = Nature::find($request->nature);
        $term = Term::find($request->term);
        $course->area_id = $area->id;
        $course->nature_id = $nature->id;
        $course->term_id = $term->id;

        $course->main_objective = $request->main_objective;
        $course->secondary_objective = $request->secondary_objective;
        $course->theoretical_hours = $request->theoretical_hours;
        $course->practical_hours = $request->practical_hours;
        $course->credits = $request->credits;
        $course->level = $request->level;
        $course->save();


        $topics = $request->topics;
        foreach ($topics as $value) {
            $topic = Topic::find($value);
            $course->topics()->attach($topic);
        }

        // foreach ($request->topics as $topic_id) {
        //     $topic_course = new TopicCourse;
        //     $topic_course->course_id = $course->id;
        //     $topic_course->topic_id = $topic_id;
        //     $topic_course->save();
        // }
        if ($request->requeriments){
            foreach ($request->requeriments as $requeriment_id) {
                $requeriment_course = new RequerimentCourse;
                $requeriment_course->course_id = $course->id;
                $requeriment_course->course_requeriment_id = $requeriment_id;
                $requeriment_course->save();
            }
        }

        $plan_controller = new PlanController();
        $plan_controller->storePlan($course->id,$course->name,$course->level);

        return response()->json(['message' => "Curso creado"], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}
