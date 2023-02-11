<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sensors;

class SensorController extends Controller
{
  public function index(){
    $data = Sensor::join('cages', 'cages.id_cage', '=', 'sensors.id_cage')
          ->join('devices', 'devices.id_device', '=', 'sensors.id_device')
          ->join('ref_sensors', 'ref_sensors.id_ref_sensor', '=', 'devices.id_ref_sensor')
          ->select('sensors.*', 'cages.address', 'cages.information', 'ref_sensors.name as sensor')->get();

    return response()->json([
      'status' => 200,
      'message' => 'Success get data!',
      'data' => [
        'size' => sizeof($data),
        'sensors' => $data->toArray()
      ],
    ],200);
  }

  public function store(Request $request){
    $request->validate([
        'id_cage' => 'required',
        'id_device' => 'required|string',
    ]);

    $data = new Sensors();
    $data->id_cage = $request->id_cage;
    $data->id_device = $request->id_device;
    $data->save();

    return response()->json([
      'message' => 'Successfully created sensor!',
      'statusCode' => 201,
      'data' => [
        'sensor' => $data
      ]
    ], 201);
  }

  public function show($id){
    $data = Sensors::join('cages', 'cages.id_cage', '=', 'sensor.id_cage')
          ->join('devices', 'devices.id_device', '=', 'sensors.id_device')
          ->join('ref_sensors', 'ref_sensors.id_ref_sensor', '=', 'devices.id_ref_sensor')
          ->select('sensors.*', 'cages.address', 'cages.information', 'ref_sensors.name as sensor')
          ->where('id_sensor',$id)
          ->get();

    return response()->json([
      'status' => 200,
      'message' => 'Success get data!',
      'data' => [
        'sensor' => $data->toArray()
      ],
    ],200);
  }

  public function update(Request $request, $id){
    $data = Sensors::where('id_sensor',$id)->first();
    $data->id_cage = $request->id_cage;
    $data->id_device = $request->id_device;
    $data->save();

    return response()->json([
      'message' => 'Successfully change data sensor!',
      'statusCode' => 200,
      'data' => [
        'sensor' => $data
      ]
    ], 200);
  }

  public function destroy($id){
    $data = Sensors::where('id_sensor',$id)->first();
    $data->delete();
  
    return response()->json([
      'message' => 'Successfully delete data sensor!',
      'statusCode' => 200,
      'data' => [
        'sensor' => $data
      ]
    ], 200);
  }
}
