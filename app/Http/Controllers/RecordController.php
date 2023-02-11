<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Records;
use App\Models\Sensors;
use App\Models\Devices;
use Auth;

class RecordController extends Controller
{
    public function index(){
      $data = Records::join('sensors', 'sensors.id_sensor', '=', 'records.id_sensor')
            ->join('devices', 'devices.id_device', '=', 'sensors.id_device')
            ->join('ref_sensors', 'ref_sensors.id_ref_sensor', '=', 'devices.id_ref_sensor')
            ->select('records.*', 'ref_sensors.name as sensor', 'ref_sensors.unit')->get();

      return response()->json([
        'status' => 200,
        'message' => 'Success get data!',
        'data' => [
          'size' => sizeof($data),
          'records' => $data->toArray()
        ],
      ],200);
    }
  
    public function store(Request $request){
      $id_device = $request->id_device;
      $id_sensor = $request->id_sensor;
      $key = $request->key;
      $cek = Devices::where('id_device',$id_device)->where('key',$key)->get();
      $cek2 = Sensors::where('id_device',$id_device)->where('id_sensor',$id_sensor)->get();

      if(count($cek)==1 && count($cek2)==1){
        $data = new Record();
        $data->id_sensor = $id_sensor;
        $data->value = $request->value;
        $data->timestamps = false;
  
        return response()->json([
          'message' => 'Successfully created record!',
          'statusCode' => 201,
          'data' => [
            'device' => $data
          ]
        ], 201);
      }
    }

    public function stat($id_kandang,$id_sensor){
      $data = Records::join('sensors', 'sensors.id_sensor', '=', 'records.id_sensor')
                ->join('devices', 'devices.id_device', '=', 'sensors.id_device')
                ->join('ref_sensors', 'ref_sensors.id_ref_sensor', '=', 'devices.id_ref_sensor')
                ->select('ref_sensors.name as sensor', 'ref_sensors.unit', DB::raw('MAX(records.value) AS max, MIN(records.value) AS min, AVG(records.value) AS avg'))
                ->groupBy('ref_sensors.name','ref_sensors.unit')
                ->where('sensors.id_sensor',$id_sensor)
                ->where('sensors.id_cage',$id_kandang)
                ->get();

      return response()->json([
        'status' => 200,
        'message' => 'Success get data!',
        'data' => [
          'size' => sizeof($data),
          'records' => $data,
        ],
      ],200);
    }

    public function stat_ref($id_kandang,$id_ref_sensor){
      $data = Record::join('sensors', 'sensors.id_sensor', '=', 'records.id_sensor')
            ->join('devices', 'devices.id_device', '=', 'sensors.id_device')
            ->join('ref_sensors', 'ref_sensors.id_ref_sensor', '=', 'devices.id_ref_sensor')
            ->select('ref_sensors.name as sensor', 'ref_sensors.unit', DB::raw('MAX(records.value) AS max, MIN(records.value) AS min, AVG(records.value) AS avg'))
            ->groupBy('ref_sensors.name','ref_sensors.unit')
            ->where('devices.id_ref_sensor',$id_ref_sensor)
            ->where('sensors.id_kandang',$id_kandang)
            ->get();

      return response()->json([
        'status' => 200,
        'message' => 'Success get data!',
        'data' => [
          'size' => sizeof($data),
          'records' => $data,
        ],
      ],200);
    }
}
