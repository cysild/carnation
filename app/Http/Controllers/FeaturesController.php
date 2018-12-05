<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Helper;
use Image;
use Yajra\Datatables\Datatables;
use App\Features;
use Validator;
use App\Make;


class featuresController extends Controller
{
    //
     function index()
     {

    	$heading  = ['id','features','image','action'];
		$tableurl = url('/admin/features/list');
		$saveurl = url('/admin/features/save');
		$viewurl = url('/admin/features/');
		$delurl = url('/admin/features/drop');

    	$pages = ['title'=>'Features Listing','basemenu'=>'Cars','currenmenu'=>'Features Listing' , 'subtitle'=>'Listing','content'=>'Features','id'=>'','type_id'=>1,'modal_name'=>'Add Features','table_url'=>$tableurl,'save_url'=>$saveurl,'view_url'=>$viewurl,'delete_url'=>$delurl];
    		foreach($heading as $head){
    			$table[] = ['data'=>Helper::table_head_lower($head),'name'=>Helper::table_head_lower($head)];
    		}
    		$table = json_encode($table);
    		return view('cars.features.index',['heading'=>$heading,'page'=>$pages,'table'=>$table]);
    }

        function store(Request $request){
        
     		    $validator = Validator::make($request->all(), [
                'features' => 'required|max:150',
                ],
                [
                 'features.required' => ' features Required',
                ]);
                if($validator->fails()) 
                {
                return response()->json(['errors'=>$validator->errors()->all()]);               
                }
		            if(!$request->id){
		    		$store = new Features;
		            }else{
		           	$store = Features::find($request->id);
		            }  	
		       if ($request->hasFile('image')) 
                {
                   $validator = Validator::make($request->all(), [
                  'image' => 'image|mimes:jpg,jpeg,png|max:2000'],[
                  'image.required' => 'Please upload an image',
                  'image.mimes' => 'Only jpeg,png and bmp images are allowed',
                  'image.max' => 'Sorry! Maximum allowed size for an image is 2MB',
                  ]);
                if($validator->fails()) 
                {
                  return response()->json(['errors'=>$validator->errors()->all()]);           
                }
                $photo = $request->file('image');
                $path = public_path('images/features');
                $size = "200,200";
                $store->images = Helper::ImageUpload($photo,$path,$size);
             }
		    		$store->features = $request->features;
		
		    		$store->save();
    		return response()->json(['success'=>'Data Recorded']);              
    }

        function table_list()
        {
			    $data = Features::where('is_delete',0)->get(['images as image','id','features']);
			     return Datatables::of($data)
			    ->editColumn('image', function ($data){
			       	$path = "/images/features/";
			   		$image = Helper::ImageCheck($path,$data->image);
			         return '<img src="'.$image.'" width="50px"/>';
			     }) ->rawColumns(['image','action'])
	   			    ->addColumn('action', function ($data) {
	                return '<a data-act="ajax-modal"  data-id="'.$data->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a> 
	                <a data-act="ajax-modal-del" data-id="'.$data->id.'" class="btn btn-xs btn-danger" ><i class="glyphicon glyphicon-edit" ></i> Delete</a>';
	            })->editColumn('id', 'ID: {{$id}}')->make(true);

    	}

        function show($id)
        {
    	   $data = Features::find($id);
           return response()->json( ['html'=>$data]);

   		 }


        function drop($id){
    	$data = Features::find($id);
    	$data->is_delete = 1;
    	$data->save();
    	return  response()->json(['success'=>'deleted ']);  

    }

       function featuresJson(){
                $data = Features::where('is_delete',0)->get(['id','features']);


          return response()->json( ['features'=>$data]);
    }

    function imageDel(Request $request){

        $image = Features::where('id',$request->p)->first();
               $ima =  json_decode($image->images);

    //    $request->i;
               unset($ima[$request->i]);

             //  return count($ima);

              $decode = $ima;
$image->images = json_encode($decode);



$image->save();

   $fimgget = Features::where('id',$request->p)->first();
       $imacount =  json_decode($fimgget->image);
               if(count($ima) == 1){

                        $fimg = Features::find($request->p);
                        $fimg->images = $imacount[0];
                        $fimg->save();
               }
               else{
                        $fimg = Features::find($request->p);
                        $fimg->images = "";
                        $fimg->save();
               }



        return  response()->json(['success'=>'images updated']);  

    }





}
