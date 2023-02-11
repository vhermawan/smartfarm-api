<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Devices;
use Auth;

class DeviceController extends Controller
{
  public function index(){
    $data = Devices::join('ref_sensors', 'ref_sensors.id_ref_sensor', '=', 'devices.id_ref_sensor')
            ->select('devices.*', 'ref_sensors.name as sensor')
            ->get();

    return response()->json([
      'status' => 200,
      'message' => 'Success get data!',
      'data' => [
        'size' => sizeof($data),
        'devices' => $data->toArray()
      ],
    ],200);
  }

  public function store(Request $request){
    $request->validate([
        'id_ref_sensor' => 'required',
        'key' => 'required|string',
    ]);

    $data = new Devices();
    $data->id_ref_sensor = $request->id_ref_sensor;
    $data->key = $request->key;
    $data->save();

    return response()->json([
      'message' => 'Successfully created device!',
      'statusCode' => 201,
      'data' => [
        'device' => $data
      ]
    ], 201);
  }

  public function show($id){
    $data = Devices::join('ref_sensors', 'ref_sensors.id_ref_sensor', '=', 'devices.id_ref_sensor')
          ->select('devices.*', 'ref_sensors.nama as sensor')
          ->where('id_device',$id)->get();

    return response()->json([
      'status' => 200,
      'message' => 'Success get data!',
      'data' => [
        'device' => $data->toArray()
      ],
    ],200);
  }

  public function update(Request $request, $id){
    $data = Devices::where('id_device',$id)->first();
    $data->key = $request->key;
    $data->save();

    return response()->json([
      'message' => 'Successfully change data device!',
      'statusCode' => 200,
      'data' => [
        'device' => $data
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
