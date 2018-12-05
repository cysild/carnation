<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Helper;
use Image;
use Yajra\Datatables\Datatables;
use App\Make;
use Validator;
class MakeController extends Controller
{
    //
    function index(){
    	$heading  = ['id','Make','image','action'];
		$tableurl = url('/admin/make/list');
		$saveurl = url('/admin/make/save');
		$viewurl = url('/admin/make/');
		$delurl = url('/admin/make/drop');
    	$pages = ['title'=>'Make Listing','basemenu'=>'Cars','currenmenu'=>'Make Listing' , 'subtitle'=>'Listing','content'=>'Make','id'=>'','type_id'=>1,'modal_name'=>'Add Make','table_url'=>$tableurl,'save_url'=>$saveurl,'view_url'=>$viewurl,'delete_url'=>$delurl];
    		foreach($heading as $head){
    			$table[] = ['data'=>Helper::table_head_lower($head),'name'=>Helper::table_head_lower($head)];
    		}
    		$table = json_encode($table);
    		return view('cars.make.index',['heading'=>$heading,'page'=>$pages,'table'=>$table]);
    }

    function store(Request $request){
        
         $validator = Validator::make($request->all(), [
                'make' => 'required|max:150|unique:car_make,make,'.$request->id,
                ],
                [
                 'make.required' => 'Car Make Required',
                ]);
                if($validator->fails()) 
                {
                return response()->json(['errors'=>$validator->errors()->all()]);               
                }
            if(!$request->id){
    		$store = new Make;

            }else{
            	    		$store = Make::find($request->id);

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

                $path = public_path('images/make');
                $size = "500,500";
                $store->logo = Helper::ImageUpload($photo,$path,$size);

             }
    		$store->make = $request->make;
                $store->description = $request->desc;

        
    		$store->save();
    		                return response()->json(['success'=>'Data Recorded']);              

    }

    function table_list(){

    	$data = Make::where('is_delete',0)->get(['id', 'make as make','logo as image']);


   return Datatables::of($data)


    ->editColumn('image', function ($data) {
       	$path = "/images/make/";
   		$image = Helper::ImageCheck($path,$data->image);
                return '<img src="'.$image.'" width="50px"/>';
            })  
                ->rawColumns(['image','action'])
   			    ->addColumn('action', function ($data) {
                return '<a data-act="ajax-modal"  data-id="'.$data->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a> 
                <a data-act="ajax-modal-del" data-id="'.$data->id.'" class="btn btn-xs btn-danger" ><i class="glyphicon glyphicon-edit" ></i> Delete</a>';
            })
         ->editColumn('id', 'ID: {{$id}}')
        ->make(true);

    }


    function show($id){
    	   $data = Make::find($id);
           return response()->json( ['html'=>$data]);

    }

    function MakeJson(){
    	  $data = Make::where('is_delete',0)->get(['id', 'make as make']);
    	  return response()->json( ['make'=>$data]);
    }



    function drop($id){
    	$data = Make::find($id);
    	if(file_exists(public_path('/images/make/'.$data->logo)))

      if($data->logo){
    	{
    		unlink(public_path('/images/make/'.$data->logo));
    	}
    }
    	$data->is_delete = 1;
    	$data->save();
    	return  response()->json(['success'=>'deleted ']);  

    }


      function imageDel(Request $request){

        $image = Make::where('id',$request->p)->first();
               $ima =  json_decode($image->logo);

    //    $request->i;
               unset($ima[$request->i]);

             //  return count($ima);

              $decode = $ima;
$image->logo = json_encode($decode);



$image->save();

   $fimgget = Make::where('id',$request->p)->first();
       $imacount =  json_decode($fimgget->image);
               if(count($ima) == 1){

                        $fimg = Make::find($request->p);
                        $fimg->logo = $imacount[0];
                        $fimg->save();
               }
               else{
                        $fimg = Make::find($request->p);
                        $fimg->logo = "";
                        $fimg->save();
               }



        return  response()->json(['success'=>'images updated']);  

    }
}
