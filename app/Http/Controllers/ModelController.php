<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Helper;
use Image;
use Yajra\Datatables\Datatables;
use App\ModelCar;
use Validator;
use App\Make;

class ModelController extends Controller
{
    //
     function index()
     {

    	$heading  = ['id','model','make','action'];
		$tableurl = url('/admin/model/list');
		$saveurl = url('/admin/model/save');
		$viewurl = url('/admin/model/');
		$delurl = url('/admin/model/drop');
	
    	$pages = ['title'=>'Model Listing','basemenu'=>'Cars','currenmenu'=>'Model Listing' , 'subtitle'=>'Listing','content'=>'Model','id'=>'','type_id'=>1,'modal_name'=>'Add Model','table_url'=>$tableurl,'save_url'=>$saveurl,'view_url'=>$viewurl,'delete_url'=>$delurl];
    		foreach($heading as $head){
    			$table[] = ['data'=>Helper::table_head_lower($head),'name'=>Helper::table_head_lower($head)];
    		}
    		$table = json_encode($table);
    		return view('cars.model.index',['heading'=>$heading,'page'=>$pages,'table'=>$table]);
    }

        function store(Request $request){
        
         $validator = Validator::make($request->all(), [
                'model' => 'required|max:150',
                'make' => 'required|not_in:0',
                ],
                [
                 'model.required' => 'Car Model Required',
                 'model.not_in' => 'Car Make Required',
                ]);
                if($validator->fails()) 
                {
                return response()->json(['errors'=>$validator->errors()->all()]);               
                }
            if(!$request->id){
    		$store = new ModelCar;
            }else{
           	$store = ModelCar::find($request->id);
            }  	
    		$store->model = $request->model;
    		$store->car_make_id = $request->make;
    		$store->save();
    		return response()->json(['success'=>'Data Recorded']);              

    }

        function table_list()
        {
    	$data = ModelCar::MakeGet();
  //return $data;
    	$x =0;

   		return Datatables::of($data)
   		               ->editColumn('id', 'ID: {{$id}}')

   			    ->addColumn('action', function ($data) {
                return '<a data-act="ajax-modal"  data-id="'.$data->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a> 
                <a data-act="ajax-modal-del" data-id="'.$data->id.'" class="btn btn-xs btn-danger" ><i class="glyphicon glyphicon-edit" ></i> Delete</a>';
            })



        
        ->make(true);

    }

        function show($id){
    	   $data = ModelCar::MakeFind($id);
           return response()->json( ['html'=>$data]);

    }


        function drop($id){
    	$data = ModelCar::find($id);
   
    	$data->is_delete = 1;
    	$data->save();
    	return  response()->json(['success'=>'deleted ']);  

    }


      function MakeJson(Request $request){
          $data = ModelCar::where('is_delete',0)->where('car_make_id',$request->set)->get(['id', 'model as model']);
          return response()->json( ['model'=>$data]);
    }



}
