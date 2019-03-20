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
        $capacities = DB::table('capacities')->select('id', 'name')->get();

        return  $capacities;
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
    }
}
