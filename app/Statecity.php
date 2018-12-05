<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Statecity extends Model
{
    //
        protected $table = 'geo_locations';


        public static function getstate(){
        	$data=DB::table('geo_locations')
        		->select('*')
        		->whereNull('parent_id')
        		->get();
        	return $data;
        }


         public static function getcity($id){
        	$data=DB::table('geo_locations')
        		->select('*')
        		->where('parent_id','=',$id)
        		->get();
        	return $data;
        }
 }