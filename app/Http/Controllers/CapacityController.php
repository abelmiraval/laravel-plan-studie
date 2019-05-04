<?php

namespace App\Http\Controllers;

use App\Capacity;
use Illuminate\Http\Request;
use DB;
class CapacityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $capacities = DB::table('capacities')->where('state','<>', 0)->orderBy('name')->select('id','code', 'name')->get();

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
        $capacity->state = 0;
        $capacity->update();
        return response()->json([
            'message' => 'Capacidad eliminada!'
        ]);
    }
}
