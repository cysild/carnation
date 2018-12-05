<?php
namespace App\Helpers;
use Image;
use App\CarImage;
use App\Make;
use App\CarType;
class General {


public static function table_head_lower($str) {
    return strtolower(str_replace("_", " ", $str));
}


public static function table_head_first($str) {
    return ucwords(str_replace("_", " ", $str));
}

public static function ImageUpload($photo,$path,$size){

	     		 $imagename = time().rand().'.'.$photo->getClientOriginalExtension(); 
                 $destinationPath = $path;
                 $thumb_img = Image::make($photo->getRealPath());
                 if($size){
                 $thumb_img = $thumb_img->resize($size);
           		  }
                 $thumb_img->save($destinationPath.'/'.$imagename,80);
                 return $imagename;
}



public static function BaseImageUpload($photo,$path,$size){

                 $imagename = time().rand().'.'.$photo->getClientOriginalExtension(); 
                 $destinationPath = $path;
                 $thumb_img = Image::make($photo->getRealPath());
            
                 $thumb_img = $thumb_img->resize(500,500);
                  
                 $thumb_img->save($destinationPath.'/'.$imagename,80);
                 return $imagename;
}


			public static function ImageCheck($path,$image){
  
					$fileurl = public_path($path);
						if($image == NULL){
									return url('/images/no-image.png');

						}
						else if(file_exists($fileurl.$image)){

							return url($path.$image);
						}
						else{
							return url('/images/no-image.png');
						}

			}

		public static	function MultipleImages($img,$path,$id,$column){
    	          foreach ($img as $key=> $value) 
                {       
                    $imagename = time().rand().'.'.$value->getClientOriginalExtension();               
                    $images[] =   $imagename; 
                                     //      return  $key;
                    $destinationPath = $path;
                    $thumb_img = Image::make($value->getRealPath());
                    $thumb_img->save($destinationPath.'/'.$imagename,80);
                }
                if(!$id){
         		    return   json_encode($images);
                }
                if($id){
                $image =  CarImage::where('id',$id)->first();
                $a1 = $image->$column;
			    if(count(json_decode($a1)) > 0){
			           $a2 = json_encode($images);
			                $a3 = array_merge(json_decode($a1),json_decode($a2));
			                $image->images = json_encode($a3);
			    }
			    else{
			     return json_encode($images);
			     
			    }
				}
		}

public static function  publishstatus($data){

if($data == 1 ){

return '<span class="label label-success">Publish</span>';
}

if($data == 0){

return '<span class="label label-default">Draft</span>';

}


}

public static function price($number){


     $decimal = (string)($number - floor($number));
        $money = floor($number);
        $length = strlen($money);
        $delimiter = '';
        $money = strrev($money);
 
        for($i=0;$i<$length;$i++){
            if(( $i==3 || ($i>3 && ($i-1)%2==0) )&& $i!=$length){
                $delimiter .=',';
            }
            $delimiter .=$money[$i];
        }
 
        $result = strrev($delimiter);
        $decimal = preg_replace("/0\./i", ".", $decimal);
        $decimal = substr($decimal, 0, 3);
 
        if( $decimal != '0'){
            $result = $result.$decimal;
        }
 
        return "Rs. ".$result;



}

public static function ImageExist($images) {
    if(file_exists(public_path().$images)) {
            return url($images);
    }
    

}

public static function MakeListing(){

    $data = Make::where('is_delete',0)->get();
    return $data;
}

public static function TypeListing(){

    $data = CarType::where('is_delete',0)->get();
    return $data;
}

}