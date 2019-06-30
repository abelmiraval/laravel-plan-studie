<?php

namespace App\Http\Controllers;

use App\Capacity;
use App\Topic;
use App\CapacityTopic;
use Illuminate\Http\Request;
use DB;
use Exception;

class CapacityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $capacities = DB::table('capacities')->where('state','=', '1')->orderBy('code')->select('id','code', 'name')->get();

        return  $capacities;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $capacities = Capacity::where('code',$request->code)->where('state','1')->get();
        //No es vacio, entonces quiere decir que hay registro con el mismo codigo
        if(!$capacities->isEmpty()){
            throw new Exception("El código ingresado ya existe !");
        }
        $this->validate($request,[
            'code' => 'required',
            'name' => 'required'
        ]);
        Capacity::create([
            "code" => $request->code,
            "name" => $request->name,
            "state" => 1
        ]);
        return response()->json(['message' => "Capacidad creada"], 200);
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
     * @param  \App\Capacity  $capacity
     * @return \Illuminate\Http\Response
     */
    public function show(Capacity $capacity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Capacity  $capacity
     * @return \Illuminate\Http\Response
     */
    public function edit(Capacity $capacity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Capacity  $capacity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Capacity $capacity)
    {
        //

        // $capacities = Capacity::where('code',$request->code)->where('state','1')->where('id','<>',$capacity->id)->get();


        $capacities = Capacity::where([ ['code', '=', $request->code], ['state', '=', '1'],['id','<>',$capacity->id] ])->get();
    
        //No es vacio, entonces quiere decir que hay registro con el mismo codigo
        if(!$capacities->isEmpty()){
            throw new Exception("El código ingresado ya existe !");
        }


        $this->validate($request,[
            'code' => 'required',
            'name' => 'required'
        ]);

        $capacity->code = request('code');
        $capacity->name = request('name');
        $capacity->save();
        return response()->json([
            'message' => 'Capacidad Actualizada!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Capacity  $capacity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Capacity $capacity)
    {
        //

        $capacitie_topics = CapacityTopic::where('capacity_id',$capacity->id)->get();
            
        if(!$capacitie_topics->isEmpty()){
            $list_topic = "";
            foreach ($capacitie_topics as $capacity_topic) {
                $topic = Topic::find($capacity_topic['topic_id']);
                $list_topic .= " - ".$topic->name." ";
            }

            throw new Exception("No se pudo eliminar la capacidad,
            porque fue asignado a los siguientes temas: ".$list_topic);

        }

        $capacity->state = 0;
        $capacity->update();
        return response()->json([
            'message' => 'Capacidad eliminada!'
        ]);
    }
}
