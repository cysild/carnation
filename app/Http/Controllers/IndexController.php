<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CarType;
use App\Listing;
use App\Make;
use App\Features;
use App\ModelCar;
class IndexController extends Controller
{
    //

    function index(){

    	$type = CarType::where('is_delete',0)->get(['type','image']);
    	//$list = Listing::where() 
    	//return $type;
		$featured = Listing::Featured('DESC','1');
    	$list =  Listing::ListView('DESC')->take(8);
        $make = Make::where('is_delete',0)->get();
       // return $list;

    	return view('frontend.home',['type'=>$type,'list'=>$list,'feature'=>$featured,'make'=>$make]);
    }

    function type(Request $request){

$type = $request->type;
$make = $request->make;


$not = "";
    	$type = Listing::CarType($latest='ASC',$type,$make,$not,0);
     	$data = Make::where('is_delete',0)->get(['id', 'make as make']);

        $desc = CarType::where('type', $request->type)->first();

// return $desc;
    
    	return view('frontend.list',['type'=>$type,'make'=>$data,'ctype'=>$request->type,'cmake'=>$request->make,'desc'=>$desc->description]);
    }

    function show(Request $request){


            $data = Listing::Details($request->id);

 $features = Features::whereIn('id',json_decode($data->features))->get();


$a1[] = "/images/listing/base/".$data->base;

if(count(json_decode($data->iimg)) > 0){
foreach (json_decode($data->iimg) as $key => $value) {
$a2[] = "/images/listing/interior/".$value;
}
}
else{
    $a2[] = "";
}

if(count(json_decode($data->ext)) > 0){
foreach (json_decode($data->ext) as $key => $value) {
$a3[] = "/images/listing/exterior/".$value;
}
}
else{
$a3[] = "";
}


$img =array_merge($a1,$a2,$a3);

$similar  = Listing::CarType($latest='ASC',$data->type,$data->make,$request->id,0);

// return $similar;
        return view('frontend.details',['data'=>$data,'images'=>$img,'features'=>$features,'similar'=>$similar]);
    }

      function make(Request $request){

$id = $request->id;
$make = $request->make;
$type = "";
$not = "";
$mid = $request->mid;
        $type = Listing::CarType($latest='ASC',$type,$make,$not,$mid);
        $data = ModelCar::where('is_delete',0)->where('car_make_id',$id)->get(['id', 'model as model']);

        $desc = Make::where('make', $request->make)->first();

// return $desc;
    
        return view('frontend.make',['type'=>$type,'model'=>$data,'ctype'=>$request->type,'cmake'=>$request->make,'desc'=>$desc->description,'mid'=>$id,'modelid'=>$mid]);
    }

    function collection(Request $request){
        $type = "";
$make = "";


$not = "";
        $type = Listing::CarType($latest='ASC',$type,$make,$not,0);
        $data = Make::where('is_delete',0)->get(['id', 'make as make']);

        $desc = CarType::where('type', $request->type)->first();

// return $desc;
    
        return view('frontend.collection',['type'=>$type,'make'=>$data,'ctype'=>$request->type]);
    }
}
