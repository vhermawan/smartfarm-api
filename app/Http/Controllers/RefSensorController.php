<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RefSensors;

class RefSensorController extends Controller
{
  public function index(){
    $data = RefSensors::all();

    return response()->json([
      'status' => 200,
      'message' => 'Success get data!',
      'data' => [
        'size' => sizeof($data),
        'refSensors' => $data->toArray()
      ],
    ],200);
  }

  public function store(Request $request){
    $request->validate([
        'name' => 'required|string',
        'unit' => 'required|string',
    ]);

    $data = new RefSensors();
    $data->name = $request->name;
    $data->unit = $request->unit;
    $data->save();

    return response()->json([
      'message' => 'Successfully created refSensor!',
      'statusCode' => 201,
      'data' => [
        'refSensor' => $data
      ]
    ], 201);
  }

  public function show($id){
    $data =  RefSensors::where('id_ref_sensor',$id)->get();

    return response()->json([
      'status' => 200,
      'message' => 'Success get data!',
      'data' => [
        'refSensor' => $data->toArray()
      ],
    ],200);
  }

  public function update(Request $request, $id){
    $data = RefSensors::where('id_ref_sensor',$id)->first();
    $data->key = $request->key;
    $data->save();

    return response()->json([
      'message' => 'Successfully change data refSensor!',
      'statusCode' => 200,
      'data' => [
        'refSensor' => $data
      ]
    ], 200);
  }

  public function destroy($id){
    $data = Devices::where('id_device',$id)->first();
    $data->delete();
  
    return response()->json([
      'message' => 'Successfully delete data device!',
      'statusCode' => 200,
      'data' => [
        'device' => $data
      ]
    ], 200);
  }
}
