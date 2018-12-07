<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
class newuser extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
public function saveUser(Request $request){
    $json = $request->json;
    $obj = json_decode($json);
    $name = $obj->name;
    $email = $obj->email;
    $allergy = $obj->allergy;
    $lat = $obj->lat;
    $lon = $obj->lon;
    $id = $obj->id;
     $im = base64_decode($obj->image);

     user::create([
'name'=>$name,
'email'=>$email,
'status'=>0,
'position'=>$lat.",".$lon,
'code_medical'=>$id,
'img_user'=>$im,
     ]);
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
