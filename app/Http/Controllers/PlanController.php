<?php

namespace App\Http\Controllers;

use App\Plan;
use App\Course;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $search = $request->search;
        // $fields = ['code as course_code','name as course_name','theoretical_hours as course_theoretical_hours', 'practical_hours as course_practical_hours','credits as course_credits', 'requeriments as course_requeriments', 'level as course_level', 'number_times', 'term as course_term_name','curriculum' ];
        $plans = $this->find($search);
        return response()->json($plans);
    }

    public function find($search){
        if($search) {
            return Plan::where('curriculum', 'like', "%$search%")
                ->orderBy('id','desc')
                ->with(['course','course.term','course.courses.course'])
                ->paginate(10);
        }
        return Plan::with(['course','course.term','course.courses.course'])
                ->orderBy('id','desc')
                ->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    public function storePlan($course_id,$course_name, $level){

        $plan = new Plan;
        $plan->course_id = $course_id;
        $number_times = $this->numberOfTimesInCurriculum($course_name);
        $plan->number_times = $number_times;
        if($number_times > 0){
            $courses = Course::where('name','=',$course_name)->get();
            $course_first = $courses->first();
            $plan->curriculum = $course_first->level;
        }else{
            $plan->curriculum = $level;
        }
        // $fecha = Carbon::now();
        $plan->save();
    }

    public function numberOfTimesInCurriculum($course_name){
        $number_times = DB::table('plans')->join('courses','plans.course_id','=','courses.id')
                                          ->where('courses.name',$course_name)->count();
        return $number_times;
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan $plan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        //
    }
}
