<?php

namespace App\Http\Controllers;

use App\Topic;
use App\Capacity;
use App\Content;

use DB;


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
        $topics = DB::table('topics')->select('id', 'name')->get();

        return  $topics;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $topic = new Topic;
        $topic->code = $request->code;
        $topic->name = $request->name;
        $topic->knowledge = $request->knowledge;
        $topic->specific = $request->specific;
        $topic->save();

        $capacities = $request->capacities;
        $contents = $request->contents;


        foreach ($capacities as $key => $value) {
            $capacity = Capacity::find($value);
            $topic->capacities()->attach($capacity);
        }

        foreach ($contents as $key => $value) {
            $content = Content::find($value);
            $topic->contents()->attach($content);
        }

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
        //
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
    }
}
