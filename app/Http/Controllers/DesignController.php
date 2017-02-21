<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Designs;
class DesignController extends Controller
{
    /**
     * Display a listing of the resource.
     * The data is retrieved from the DesignDatabase and the result is an object.
     * Convert Object to Array.
     * @return \Illuminate\Http\Response
     * @return Response
     */
    public function index()
    {
        $design_url = array();
        $designs = Designs::all();
        $size=array("width" => 60, "height" => 50, "crop" => "fill");
        foreach($designs as $design){
            $design_url[$design->id]['id']=$design->id;
            $design_url[$design->id]['url']=cloudinary_url($design->design_url_id,$size);
            $design_url[$design->id]['info']=json_decode($design->info_design,true);
        }
        return response()->json($design_url);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
