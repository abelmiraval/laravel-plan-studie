<?php

namespace App\Http\Controllers;

use App\Content;
use Illuminate\Http\Request;
use DB;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contents = DB::table('contents')->where('state','<>', 0)->orderBy('name')->select('id', 'code', 'name')->get();


        return  $contents;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request )
    {
        //
        $this->validate($request,[
            'code' => 'required',
            'name' => 'required'
        ]);
        Content::create([
            "code" => $request->code,
            "name" => $request->name,
            "state" => 1
        ]);
        return response()->json(['message' => "Contenido creado"], 200);
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
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function show(Content $content)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit(Content $content)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Content $content)
    {
        //
        $this->validate($request,[
            'code' => 'required',
            'name' => 'required'
        ]);

        $content->code = request('code');
        $content->name = request('name');
        $content->save();
        return response()->json([
            'message' => 'Contenido Actualizada!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy(Content $content)
    {
        //
        $content->state = 0;
        $content->update();
        return response()->json([
            'message' => 'Contenido eliminada!'
        ]);
    }
}
