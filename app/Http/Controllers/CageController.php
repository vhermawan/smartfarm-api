<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cages;
use Auth;

class CageController extends Controller
{
    public function index(){
      $data = Cages::join('users', 'users.id_users', '=', 'cages.id_users')
            ->select('cage.*', 'users.name as pemilik')
            ->get();

      return response()->json([
        'status' => 200,
        'message' => 'Success get data!',
        'data' => [
          'size' => sizeof($data),
          'cages' => $data->toArray()
        ],
      ],200);
    }

    public function store(Request $request){

      $request->validate([
        'address' => 'required|string',
        'name' => 'required|string',
      ]);

      $data = new Cages();
      $data->id_users = Auth::user()->id_users;
      $data->address = $request->address;
      $data->name = $request->name;
      $data->save();

      return response()->json([
        'message' => 'Successfully created cage!',
        'statusCode' => 201,
        'data' => [
          'cage' => $data
        ]
      ], 201);
    }

    public function show($id){
      $data = Cages::join('users', 'users.id_users', '=', 'cages.id_users')
                ->select('cages.*', 'users.nama as pemilik')
                ->where('id_cages',$id)->get();

      return response()->json([
        'status' => 200,
        'message' => 'Success get data!',
        'data' => [
          'cage' => $data->toArray()
        ],
      ],200);
    }

    public function update(Request $request, $id){
      $data = Cages::where('id_cages',$id)->first();
      $data->name = $request->name;
      $data->address = $request->address;
      $data->information = $request->information;
      $data->save();

      return response()->json([
        'message' => 'Successfully change data cage!',
        'statusCode' => 200,
        'data' => [
          'cage' => $data
        ]
      ], 200);
    }

    public function destroy($id){
      $data = Cages::where('id_cages',$id)->first();
      $data->delete();
      
      return response()->json([
        'message' => 'Successfully delete data cage!',
        'statusCode' => 200,
        'data' => [
          'cage' => $data
        ]
      ], 200);
    }
}
