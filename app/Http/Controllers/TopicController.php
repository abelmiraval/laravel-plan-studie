<?php

namespace App\Http\Controllers;

use App\Topic;
use App\Capacity;
use App\Content;
use App\Course;
use App\CourseTopic;
use DB;
use Exception;

use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $topics = Topic::where('state','=','1')->with(['capacities','contents'])->orderBy('code')->get();

        return  $topics;
    }

    public function topics()
    {
        $topics = DB::table('topics')->where('state','=','1')->select('id', 'name')->orderBy('code')->get();

        return  $topics;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {


        $topics = Topic::where('code',$request->code)->where('state','1')->get();
        //No es vacio, entonces quiere decir que hay registro con el mismo codigo
        if(!$topics->isEmpty()){
            throw new Exception("El código ingresado ya existe !");
        }

        $topic = new Topic;
        $topic->code = $request->code;
        $topic->name = $request->name;
        $topic->knowledge = $request->knowledge;
        $topic->specific = $request->specific;
        $topic->content = $request->content;
        $topic->save();

        $capacities = $request->capacities;
        // $contents = $request->contents;


        foreach ($capacities as $key => $value) {
            $capacity = Capacity::find($value);
            $topic->capacities()->sync($capacity);
        }

        // foreach ($contents as $key => $value) {
        //     $content = Content::find($value);
        //     $topic->contents()->attach($content);
        // }

        return response()->json(['message' => "Tema creado"], 200);
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
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topic $topic)
    {

        $topics = Topic::where([ ['code', '=', $request->code], ['state', '=', '1'],['id','<>',$topic->id] ])->get();
    
        //No es vacio, entonces quiere decir que hay registro con el mismo codigo
        if(!$topics->isEmpty()){
            throw new Exception("El código ingresado ya existe !");
        }


        $this->validate($request,[
            'code' => 'required',
            'name' => 'required'
        ]);

        $topic->code = $request->code;
        $topic->name = $request->name;
        $topic->knowledge = $request->knowledge;
        $topic->specific = $request->specific;
        $topic->content = $request->content;


        $capacities = $request->capacities;
        // $contents = $request->contents;  


        // foreach ($capacities as $key => $value) {
        //     $capacity = Capacity::find($value);
        $topic->capacities()->sync($capacities);
        // }

        // foreach ($contents as $key => $value) {
        //     $content = Content::find($value);
        //     $topic->contents()->sync($content,false);
        // }

        $topic->save();
        return response()->json([
            'message' => 'Tema Actualizado!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        //

        $courses_topic = CourseTopic::where('topic_id', $topic->id)->get();
    
        if(!$courses_topic->isEmpty()){
            $list_course = "";
            foreach ($courses_topic as $course_topic) {
                $course = Course::find($course_topic['course_id']);
                $list_course .= " - ".$course->name." ";
            }
            throw new Exception("No se pudo eliminar el tema,
            porque fue asignado a los siguientes cursos: ".$list_course);
        }

        $topic->state = 0;
        $topic->update();
        return response()->json([
            'message' => 'Tema eliminado!'
        ]);
    }
}
