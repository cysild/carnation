<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelCar extends Model
{
    //
            protected $table = 'car_model';

   public static function MakeGet($status = 0)
    {

    	$data =  ModelCar::where('car_model.is_delete',$status)->join('car_make','car_make.id','car_model.car_make_id')
    	->get(['car_model.id','car_model.model','car_make.make']);
        return $data;
    }

   public static function MakeFind($id)
    {

    	$data =  ModelCar::where('car_model.id',$id)->join('car_make','car_make.id','car_model.car_make_id')
    	->first(['car_model.id','car_model.model','car_make.make','car_model.car_make_id as model_id']);
        return $data;
    }

       
}
