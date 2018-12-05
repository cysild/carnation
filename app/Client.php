<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


use DB;

class Client extends Model
{

	protected $table = 'client';

	public  static function selectall(){
		$data=DB::table('client')
			->select('*')
			->where('status',1)
			->where('is_delete',0)
			->get();
		return $data;
	}

	public static function checkuser($phone2){
		$data=DB::table('client')
		->where('phone1','=',$phone2)
		->count();

		return $data;
	}

	public static function select($id){
		$data=DB::table('client')
		->join('geo_locations','client.city_id','=','geo_locations.id')
			->select('client.first_name','client.last_name','client.email','client.phone1','client.phone2','client.address','client.zipcode','geo_locations.id as placeid','client.state_id','client.city_id','client.id')
			->where('client.id',$id)
			->first();

		return $data;
	}
}