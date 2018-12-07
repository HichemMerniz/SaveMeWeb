<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\ambulance;
class emergencyLocation extends Controller
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

    public function sendHelp(Request $request){
       
        $json = $request->json;
      $obj = json_decode($json);
      $lon = $obj->status;
      $id = $obj->id;
      DB::table('users')
      ->where('code_medical', $id)
      ->update(['status' =>1]);
      $doctor = DB::table('doctors')
      ->where('status', 0)->first();
      DB::table('doctors')
      ->where('id', $doctor->id)
      ->update(['status' =>1,'code_hopital'=>$id]);
        
        return response()->json(['status'=>'Sending help']);
    }
public function ambuPosiReq(Request $request){
    $json = json_decode($request->json);
    $id = $json->id;
    $ambi =  DB::table('ambulance')->where('code_hopital',$id)->first();
    return response()->json(['position'=>$ambi->position]);
}
    public function ambuPosi(Request $request){
        $posi = $request->position;
        $distance = $request->distance;
        $id = $request->id;
        $ambu =DB::table('ambulance')
        ->where('code_hopital', $id)->get();
        if($ambu->count()> 0){
        DB::table('ambulance')
        ->where('code_hopital', $id)
        ->update(['position' =>$posi,"distance"=>$distance]); 
        }else{
ambulance::create([
'code_hopital'=>$id,
'distance'=>$distance,
'position'=>$posi,
]);
        }
    }
    public function GetAmbuPosi(Request $request){
       
        
        $id = $request->id;
        $ambu =DB::table('ambulance')
        ->where('code_medical', $id)->get();

        return response()->json(['distance'=>$ambu->position]);
         

    }
    public function saveLocation(Request $request){
       
        $json = $request->json;
      $obj = json_decode($json);
      $lon = $obj->lon;
      $lat = $obj->lat;
      $id = $obj->id;
      DB::table('users')
      ->where('code_medical', $id)
      ->update(['position' => $lat.",".$lon]);
       
        
        return response()->json(['status'=>'success']);
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
