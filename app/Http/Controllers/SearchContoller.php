<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Listing;
use App\Make;

class SearchContoller extends Controller
{
    //

    function  search(Request $request){

// return $request->all();
    	$list =  Listing::Search($request->from,$request->to,$request->price,$request->search);

    	        $data = Make::where('is_delete',0)->get(['id', 'make as make']);

    	        //return $list;

    	   return view('frontend.search',['type'=>$list,'make'=>$data,'from'=>$request->from,'to'=>$request->to]);
    }
}
