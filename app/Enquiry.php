<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


use DB;

class Enquiry extends Model
{

	protected $table = 'enquiry';

	public  static function selectall(){
		$data=DB::table('enquiry')
		->join('car_make','car_make.id','enquiry.make')
		->join('car_model','car_model.id','enquiry.model')
			->select('enquiry.*','car_make.make','car_model.model')
			->where('enquiry.status',1)
			->where('enquiry.is_delete',0)
			->get();
		return $data;
	}

	public static function select($id){
		$data=DB::table('enquiry')
			->select('*')
			->where('id',$id)
			->first();

		return $data;
	}


}