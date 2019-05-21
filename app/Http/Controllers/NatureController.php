<?php

namespace App\Http\Controllers;

use App\Nature;
use Illuminate\Http\Request;
use DB;

class NatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $natures = DB::table('natures')->select('id', 'name')->orderBy('name')->get();

        return  $natures;
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
     * @param  \App\Nature  $nature
     * @return \Illuminate\Http\Response
     */
    public function show(Nature $nature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Nature  $nature
     * @return \Illuminate\Http\Response
     */
    public function edit(Nature $nature)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nature  $nature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nature $nature)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nature  $nature
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nature $nature)
    {
        //
    }
}
