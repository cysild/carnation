<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    //

                 protected $table = 'car_listing';


                 public static function EditView($id){
                 $data = Listing::select('cars.title','car_listing.id as id','car_make.id as make','car_model.id as model','cars.is_enabled as status','car_listing.created_at as publish','car_types.id as type','car_listing.model_year as year' ,'car_transmission.id as transmission','car_fuel.id as fuel','car_listing.register_year','car_listing.km_driven as driven','car_listing.price','car_listing.owners','car_listing.color','car_listing.exterior','car_listing.interior','car_listing.life_time_tax','car_listing.insurance','cars.features','cars.specification as spec','cars.is_featured as featured','cars.is_booked as booked','car_images.base','car_images.interior as iimg','car_images.exterior as ext')
   ->where('car_listing.id',$id)
      ->join('cars','cars.id','=','car_listing.cars_id')
      ->join('car_types','car_types.id','car_listing.car_type_id')
      ->join('car_images','car_images.id','car_listing.car_images_id')
      ->join('car_transmission','car_transmission.id','car_listing.car_transmission_id')
      ->join('car_fuel','car_fuel.id','car_listing.car_fuel_id')
      ->leftjoin('car_model','car_model.id','=','car_listing.car_model_id')
      ->leftjoin('car_make','car_make.id','=','car_model.car_make_id')
      ->first();

      return $data;
                 }



                 public static function ListView($latest ='DESC')
                 {
                 $data = Listing::select('cars.title','car_listing.id as id','car_make.make as make','car_model.model as model','cars.is_enabled as status','car_listing.created_at as publish','car_types.id as type','car_listing.model_year as year' ,'car_transmission.transmission as transmission','car_fuel.fuel as fuel','car_listing.register_year','car_listing.km_driven as driven','car_listing.price','car_listing.owners','cars.is_featured as featured','cars.is_booked as booked','car_images.base')
   ->where('cars.is_enabled',1)

       ->where(function($query) use ($latest) {
        if($latest){
                     $query->orderBy('car_listing.created_at',$latest);
        }
    })

  

   
      ->join('cars','cars.id','=','car_listing.cars_id')
      ->join('car_types','car_types.id','car_listing.car_type_id')
      ->join('car_images','car_images.id','car_listing.car_images_id')
      ->join('car_transmission','car_transmission.id','car_listing.car_transmission_id')
      ->join('car_fuel','car_fuel.id','car_listing.car_fuel_id')
      ->leftjoin('car_model','car_model.id','=','car_listing.car_model_id')
      ->leftjoin('car_make','car_make.id','=','car_model.car_make_id')
      ->get();

      return $data;
                 }


    public static function Featured($latest ='ASC',$featured ='1')
                 {
                 $data = Listing::select('cars.title','car_listing.id as id','car_make.make as make','car_model.model as model','cars.is_enabled as status','car_listing.created_at as publish','car_types.id as type','car_listing.model_year as year' ,'car_transmission.transmission as transmission','car_fuel.fuel as fuel','car_listing.register_year','car_listing.km_driven as driven','car_listing.price','car_listing.owners','cars.is_featured as featured','cars.is_booked as booked','car_images.base')
   ->where('cars.is_enabled',1)

       ->where(function($query) use ($latest) {
        if($latest){
                     $query->orderBy('car_listing.created_at',$latest);
        }
    })

           ->where(function($query) use ($featured) {
        if($featured){
                     $query->where('cars.is_featured',1);
        }
    })   
      ->join('cars','cars.id','=','car_listing.cars_id')
      ->join('car_types','car_types.id','car_listing.car_type_id')
      ->join('car_images','car_images.id','car_listing.car_images_id')
      ->join('car_transmission','car_transmission.id','car_listing.car_transmission_id')
      ->join('car_fuel','car_fuel.id','car_listing.car_fuel_id')
      ->leftjoin('car_model','car_model.id','=','car_listing.car_model_id')
      ->leftjoin('car_make','car_make.id','=','car_model.car_make_id')
      ->get();

      return $data;
                 }



                  public static function CarType($latest ='ASC',$type,$make,$not,$mid)
                 {
                 $data = Listing::select('cars.title','car_listing.id as id','car_make.make as make','car_model.model as model','cars.is_enabled as status','car_listing.created_at as publish','car_types.id as type','car_listing.model_year as year' ,'car_transmission.transmission as transmission','car_fuel.fuel as fuel','car_listing.register_year','car_listing.km_driven as driven','car_listing.price','car_listing.owners','cars.is_featured as featured','cars.is_booked as booked','car_images.base')
   ->where('cars.is_enabled',1)

       ->where(function($query) use ($latest) {
        if($latest){
                     $query->orderBy('car_listing.created_at',$latest);
        }
    })

           ->where(function($query) use ($type,$make,$not,$mid) {
        if($type){
                     $query->where('car_types.slug',$type);
        }
        if($make){
        	                     $query->where('car_make.make',$make);

        }

               if($not){
                               $query->where('car_listing.id','!=',$not);

        }

               if($mid){
                               $query->where('car_model.id',$mid);

        }

    })   
      ->join('cars','cars.id','=','car_listing.cars_id')
      ->join('car_types','car_types.id','car_listing.car_type_id')
      ->join('car_images','car_images.id','car_listing.car_images_id')
      ->join('car_transmission','car_transmission.id','car_listing.car_transmission_id')
      ->join('car_fuel','car_fuel.id','car_listing.car_fuel_id')
      ->leftjoin('car_model','car_model.id','=','car_listing.car_model_id')
      ->leftjoin('car_make','car_make.id','=','car_model.car_make_id')
      ->get();

      return $data;
                 }




          public static function Details($id)
                 {
        $data =  Listing::select('cars.title','car_listing.id as id','car_make.make as make','car_make.id as makeid','car_model.model as model','cars.is_enabled as status','car_listing.created_at as publish','car_types.type as type','car_types.id as typeid','car_listing.model_year as year' ,'car_transmission.transmission as transmission','car_fuel.fuel as fuel','car_listing.register_year','car_listing.km_driven as driven','car_listing.price','car_listing.owners','car_listing.color','car_listing.exterior','car_listing.interior','car_listing.life_time_tax','car_listing.insurance','cars.features','cars.specification as spec','cars.is_featured as featured','cars.is_booked as booked','car_images.base','car_images.interior as iimg','car_images.exterior as ext')
      ->where('car_listing.id',$id)
      ->join('cars','cars.id','=','car_listing.cars_id')
      ->join('car_types','car_types.id','car_listing.car_type_id')
      ->join('car_images','car_images.id','car_listing.car_images_id')
      ->join('car_transmission','car_transmission.id','car_listing.car_transmission_id')
      ->join('car_fuel','car_fuel.id','car_listing.car_fuel_id')
      ->leftjoin('car_model','car_model.id','=','car_listing.car_model_id')
      ->leftjoin('car_make','car_make.id','=','car_model.car_make_id')
      ->first();

      return $data;
                 }

        public static function Search($from,$to,$price=0,$search=0){



               $data = Listing::select('cars.title','car_listing.id as id','car_make.make as make','car_model.model as model','cars.is_enabled as status','car_listing.created_at as publish','car_types.id as type','car_listing.model_year as year' ,'car_transmission.transmission as transmission','car_fuel.fuel as fuel','car_listing.register_year','car_listing.km_driven as driven','car_listing.price','car_listing.owners','cars.is_featured as featured','cars.is_booked as booked','car_images.base')
   ->where('cars.is_enabled',1)

       ->where(function($query) use ($from,$to,$price,$search) {
   

if($price){
    if($from && $to){

       $query->whereBetween('car_listing.price', [$from, $to]);

    }
}

if($search){
       $query->where('cars.title', $search);
              $query->orWhere('car_make.make', $search);
                        $query->orWhere('car_model.model', $search);
                  $query->orWhere('car_listing.model_year', $search);
}


    })   
      ->join('cars','cars.id','=','car_listing.cars_id')
      ->join('car_types','car_types.id','car_listing.car_type_id')
      ->join('car_images','car_images.id','car_listing.car_images_id')
      ->join('car_transmission','car_transmission.id','car_listing.car_transmission_id')
      ->join('car_fuel','car_fuel.id','car_listing.car_fuel_id')
      ->leftjoin('car_model','car_model.id','=','car_listing.car_model_id')
      ->leftjoin('car_make','car_make.id','=','car_model.car_make_id')
      ->get();
return $data;

        }         







}
