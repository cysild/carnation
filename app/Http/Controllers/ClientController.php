<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Yajra\Datatables\Datatables;
use Validator;
use App\Gallery;
use Image;
use Helpercus;
use App\Client;
use App\Statecity;
use App\Enquiry;
use File;
use Auth;
use Helper;
class ClientController extends Controller{

	function ClientListing(){
			$pages = ['title'=>'ClientListing','basemenu'=>'Client','currenmenu'=>'Client Listing' , 'subtitle'=>'Listing','content'=>'Client','id'=>'','type_id'=>1,'modal_name'=>'Add Client'];
			$data=Statecity::getstate();
			return view('content.client')->with(['page'=>$pages,'states'=>$data]);
		}


	function EnquiryListing(){
			$pages = ['title'=>'EnquiryListing','basemenu'=>'Enquiry','currenmenu'=>'Enquiry Listing' , 'subtitle'=>'Listing','content'=>'Enquiry','id'=>'','type_id'=>1,'modal_name'=>'Add Enquiry'];
			return view('content.enquiry')->with('page',$pages);
		}

	function clientcontent(){
		$data=Client::selectall();
		
		 return Datatables::of($data)
      ->editColumn('status', function ($data) {
                return Helper::publishstatus($data->status);
            })  
                ->rawColumns(['status','action'])
     			->addColumn('action', function ($data) {
                return '<a data-act="ajax-modal"  data-id="'.$data->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a> 
        			 <a data-act="ajax-modal-del" data-id="'.$data->id.'" class="btn btn-xs btn-danger" ><i class="glyphicon glyphicon-edit" ></i> Delete</a>';
            })
         ->editColumn('id', '{{$id}}')
        ->make(true);
	}


	 /*function StateList(){
	
		$data=Statecity::getstate();
		$res=array();
         foreach ($data as $value) { 
         	  $res[]= array(
                     'name' => $value->name,
                     'id' => $value->id
                );
        }
    	 return response()->json($res);
}*/


		 function CityList($id){
	
		$data=Statecity::getcity($id);
		/*$res=array();
         foreach ($data as $value) { 
         	  $res[]= array(
                     'name' => $value->name,
                     'id' => $value->id
                );
        }*/
    	 return response()->json($data);
}


	public function store(Request $req){

    	if($req->id == ''){
    		$validator = Validator::make($req->all(), [
	       		'first_name' => 'required|max:150',
	       	    'last_name' => 'required|max:150',
	       	   	'email' => 'required|unique:client|email',
	       	   	'phone1' => 'required|unique:client|max:13|regex:/^\+?\d[0-9-]{9,12}/ ',
	       	   	'phone2' => 'unique:client|max:13|regex:/^\+?\d[0-9-]{9,12}/ ',
	       	   	'address' => 'required',
	       	   	'state' => 'required',
	       	   	'city' => 'required',
	       	   	'zipcode' => 'required',


	    		],
	            [
	             'first_name.required' => 'First Name Required',
	             'last_name.required' => 'Last Name Required',
	             'email.required' => 'Email Required',
	             'email.email'	=> 'Must Be a Valid Email',
	             'phone1.required' => 'Phone1 Required',
	             'phone2.required'	=> 'Phone2 Required',
	             'address.required'	=> 'Address Required',
	             'state.required'	=>'State Required',
	             'city.required'	=> 'City Required',
	             'zipcode.required'	=>	'Zipcode Required',
	             
	            ]);
				if($validator->fails()) 
				{
				return response()->json(['errors'=>$validator->errors()->all()]);	  	


				$result=Client::checkuser($req->phone2);
				if($result != 0){

					return response()->json(['error'=>'Phone2 has already been taken']);
				}
		
				}
				$store = new Client;
			}
			else{
				$validator = Validator::make($req->all(), [
	       		'first_name' => 'required|max:150',
	       	    'last_name' => 'required|max:150',
	       	   	'email' => 'required|email',
	       	   	'phone1' => 'required|max:13|regex:/^\+?\d[0-9-]{9,12}/ ',
	       	   	'phone2' => 'max:13|regex:/^\+?\d[0-9-]{9,12}/ ',
	       	   	'address' => 'required',
	       	   	'state' => 'required',
	       	   	'city' => 'required',
	       	   	'zipcode' => 'required',


	    		],
	            [
	             'first_name.required' => 'First Name Required',
	             'last_name.required' => 'Last Name Required',
	             'email.required' => 'Email Required',
	             'email.email'	=> 'Must Be a Valid Email',
	             'phone1.required' => 'Phone number Required',
	             'phone2.required'	=> 'Phone2 Required',
	             'address.required'	=> 'Address Required',
	             'state.required'	=>'State Required',
	             'city.required'	=> 'City Required',
	             'zipcode.required'	=>	'Zipcode Required',
	             
	            ]);
				if($validator->fails()) 
				{
				return response()->json(['errors'=>$validator->errors()->all()]);	  			
				}


				$result=Client::checkuser($req->phone2);
				if($result != 0){

					return response()->json(['error'=>'Phone2 has already been taken']);
				}

				$store = Client::find($req->id);
			}
          $store->first_name = $req->first_name;
          $store->last_name=$req->last_name;
           $store->email=$req->email;
          $store->phone1=$req->phone1;
         	$store->phone2=$req->phone2;
          $store->address=$req->address;
          $store->state_id=$req->state;
          $store->city_id = $req->city;
          $store->zipcode=$req->zipcode;
          $store->status=1;
          $store->is_delete=0;

          $store->save();

          return response()->json(['success'=>'Record Added']);
    
  }


  public function ClientGet($id){

  	$data=Client::select($id);
  	return response()->json( ['html'=>$data]);
  }

  public function clientdel($id){
  		$del=Client::find($id);
  		$del->delete();
		return response()->json(['success'=>'Record Deleted']);
	}

	public function enquirycontent(){
		$data=Enquiry::selectall();
		
		 return Datatables::of($data)
      ->editColumn('status', function ($data) {
                return Helper::publishstatus($data->status);
            })  
                ->rawColumns(['status','action'])
     			->addColumn('action', function ($data) {
                return '<a data-act="ajax-modal"  data-id="'.$data->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a> 
        			 <a data-act="ajax-modal-del" data-id="'.$data->id.'" class="btn btn-xs btn-danger" ><i class="glyphicon glyphicon-edit" ></i> Delete</a>';
            })
         ->editColumn('id', '{{$id}}')
        ->make(true);
	}


	public function enquirystore(Request $req){

    	if($req->id == ''){
    		$validator = Validator::make($req->all(), [
	       		/*'make' => 'required',
	       	    'model' => 'required',*/
	       	    'first_name' => 'required|max:150',
	       	    'last_name' => 'required|max:150',
	       	   	'email' => 'required|unique:enquiry|email',
	       	   	'phone' => 'required|unique:enquiry|max:13|regex:/^\+?\d[0-9-]{9,12}/ ',
	    		],
	            [

	         /*    'make'	=> 'Make Required',
	             'model'=>	'Model Required',*/
	             'first_name.required' => 'First Name Required',
	             'last_name.required' => 'Last Name Required',
	             'email.required' => 'Email Required',
	             'email.email'	=> 'Must Be a Valid Email',
	             'phone.required' => 'Phone1 Required',
	             
	             
	            ]);
				if($validator->fails()) 
				{
				return response()->json(['errors'=>$validator->errors()->all()]);	  	
		
				}
				$store = new Enquiry;
			}
			else{
				$validator = Validator::make($req->all(), [
	       		'make' => 'required',
	       	    'model' => 'required',
	       	    'first_name' => 'required|max:150',
	       	    'last_name' => 'required|max:150',
	       	   	'email' => 'required|email',
	       	   	'phone' => 'required|max:13|regex:/^\+?\d[0-9-]{9,12}/ ',
	    		],
	            [

	             'make'	=> 'Make Required',
	             'model'=>	'Model Required',
	             'first_name.required' => 'First Name Required',
	             'last_name.required' => 'Last Name Required',
	             'email.required' => 'Email Required',
	             'email.email'	=> 'Must Be a Valid Email',
	             'phone.required' => 'Phone1 Required',
	             
	             
	            ]);
				if($validator->fails()) 
				{
				return response()->json(['errors'=>$validator->errors()->all()]);	  			
				}

				$store = Enquiry::find($req->id);
			}
          $store->first_name = $req->first_name;
          $store->last_name=$req->last_name;
          $store->email=$req->email;
          $store->make=$req->make;
          $store->model=$req->model;
          $store->phone=$req->phone;
          $store->status=1;
          $store->is_delete=0;
          if (Auth::check()){
          	$store->created_by=1;
          }
          else{
          	$store->created_by=0;
          }

          $store->save();

          return response()->json(['success'=>'Record Added']);
    
  }

  	public function EnquiryGet($id){

  	$data=Enquiry::select($id);
  	return response()->json( ['html'=>$data]);
  }


  public function enquirydel($id){
  		$del=Enquiry::find($id);
  		$del->delete();
		return response()->json(['success'=>'Record Deleted']);
	}


	function requeststore(Request $request){


			$validator = Validator::make($request->all(), [
	       	    'name' => 'required|max:150',
	       	   	'email' => 'required',
	       	   	'phone' => 'required|max:13|regex:/^\+?\d[0-9-]{9,12}/ ',
	    		],
	            [

	         /*    'make'	=> 'Make Required',
	             'model'=>	'Model Required',*/
	             'name.required' => 'First Name Required',
	             'email.required' => 'Email Required',
	 
	             'phone.required' => 'Phone Number Required',
	             
	             
	            ]);
				if($validator->fails()) 
				{
				return response()->json(['errors'=>$validator->errors()->all()]);	  	
		
				}


				$data = DB::table('call_back')->insert(['name'=>$request->name,'email'=>$request->email,'phone'=>$request->phone]);


				return response()->json(['success'=>"Request Added Call Back by You Soon"]);
	}


	function RequestListing(){

			$data= DB::table('call_back')->orderby('created_at','DESC')->get(['name','phone','email','created_at as date','id']);
		$id = 0;

	
		 return Datatables::of($data)
    
        ->make(true);

	}

	function request(){

				$pages = ['title'=>'Call Back Listing','basemenu'=>'Call Back','currenmenu'=>'Call Back  Listing' , 'subtitle'=>'Listing','content'=>'Call Back ','id'=>'','type_id'=>1,'modal_name'=>'Add Client'];
			$data=Statecity::getstate();
			return view('content.call')->with(['page'=>$pages,'states'=>$data]);

	}


}
?>