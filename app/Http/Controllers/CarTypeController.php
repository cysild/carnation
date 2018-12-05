<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Helper;
use Image;
use Yajra\Datatables\Datatables;
use App\CarTypeCar;
use Validator;
use App\Make;
use App\CarType;
use DB;
class CarTypeController extends Controller
{
    //
     function index()
     {

    	$heading  = ['id','type','image','action'];
		$tableurl = url('/admin/cartype/list');
		$saveurl = url('/admin/cartype/save');
		$viewurl = url('/admin/cartype/');
		$delurl = url('/admin/cartype/drop');

    	$pages = ['title'=>'CarType Listing','basemenu'=>'Cars','currenmenu'=>'CarType Listing' , 'subtitle'=>'Listing','content'=>'CarType','id'=>'','type_id'=>1,'modal_name'=>'Add CarType','table_url'=>$tableurl,'save_url'=>$saveurl,'view_url'=>$viewurl,'delete_url'=>$delurl];
    		foreach($heading as $head){
    			$table[] = ['data'=>Helper::table_head_lower($head),'name'=>Helper::table_head_lower($head)];
    		}
    		$table = json_encode($table);
    		return view('cars.cartype.index',['heading'=>$heading,'page'=>$pages,'table'=>$table]);
    }

       function store(Request $request){



           $validator = Validator::make($request->all(), [
                'type' => 'unique:car_types,type,'.$request->id,
                ],
                [
                 'CarType.required' => ' CarType Required',
                ]);
                if($validator->fails()) 
                {
                    $result = DB::table('car_types')
                    ->where('type','=',$request->type)
                    ->select('*')
                    ->first();
                    $store = CarType::find($result->id);
                   if($store->is_delete == 1){
                    $store->is_delete=0;
                    $store->save();

                  return response()->json(['success'=>'Already the type taken so enabled that ']); 

                     
                   }  
                    
                    else{

                     return response()->json(['errors'=>$validator->errors()->all()]);
                  }

                }



        
            $validator = Validator::make($request->all(), [
                'type' => 'required|max:150',
                ],
                [
                 'CarType.required' => ' CarType Required',
                ]);
                if($validator->fails()) 
                {
                return response()->json(['errors'=>$validator->errors()->all()]);               
                }


                if(!$request->id){
            $store = new CarType;
                }else{
                $store = CarType::find($request->id);
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
                $path = public_path('images/types');
                $size = "200,200";
                $store->image = Helper::ImageUpload($photo,$path,$size);
             }

       

            $store->type = $request->type;
                        $store->description = $request->desc;

            $store->slug = str_slug($request->type);
            $store->save();
        return response()->json(['success'=>'Data Recorded']); 
        }             
    

        function table_list()
        {

    $data = CarType::where('is_delete',0)->get(['image','id','type']);
     return Datatables::of($data)
    ->editColumn('image', function ($data) {
       	$path = "/images/types/";
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

        function show($id)
        {
    	   $data = CarType::find($id);
           return response()->json( ['html'=>$data]);

   		 }


        function drop($id){
    	$data = CarType::find($id);
    	$data->is_delete = 1;
    	$data->save();
    	return  response()->json(['success'=>'deleted ']);  

    }

          function MakeJson(Request $request){
          $data = CarType::where('is_delete',0)->get(['id', 'type as type' ]);
          return response()->json( ['type'=>$data]);
    }



    function imageDel(Request $request){

        $image = CarType::where('id',$request->p)->first();
               $ima =  json_decode($image->image);

    //    $request->i;
               unset($ima[$request->i]);

             //  return count($ima);

              $decode = $ima;
$image->image = json_encode($decode);



$image->save();

   $fimgget = CarType::where('id',$request->p)->first();
       $imacount =  json_decode($fimgget->image);
               if(count($ima) == 1){

                        $fimg = CarType::find($request->p);
                        $fimg->image = $imacount[0];
                        $fimg->save();
               }
               else{
                        $fimg = CarType::find($request->p);
                        $fimg->image = "";
                        $fimg->save();
               }



        return  response()->json(['success'=>'images updated']);  

    }




}
