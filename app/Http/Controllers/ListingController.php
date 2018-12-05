<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Helper;
use DB;
use App\Features;
use App\Listing;
use App\Cars;
use App\CarImage;
use Yajra\Datatables\Datatables;
use Image;
use Validator;
class ListingController extends Controller
{
    //
    function index(){


    $heading  = ['id','title','model','type','publish','status','action'];
    $tableurl = url('/admin/listing/list');
    $saveurl = url('/admin/listing/save');
    $viewurl = url('/admin/listing/');
    $delurl = url('/admin/listing/drop');
      $features = Features::where('is_delete',0)->get(['id','features']);

      $pages = ['title'=>'Car Listing','basemenu'=>'Inventery','currenmenu'=>'cars Listing' , 'subtitle'=>'Listing','content'=>'Listing','id'=>'','type_id'=>1,'modal_name'=>'Add Listing','table_url'=>$tableurl,'save_url'=>$saveurl,'view_url'=>$viewurl,'delete_url'=>$delurl];
        foreach($heading as $head){
          $table[] = ['data'=>Helper::table_head_lower($head),'name'=>Helper::table_head_lower($head)];
        }
        $table = json_encode($table);
        return view('listing.index',['heading'=>$heading,'page'=>$pages,'table'=>$table,'features'=>$features]);
    }

    function show($id){


   $data = Listing::EditView($id);

        return response()->json( ['html'=>$data,'iimg'=>json_decode($data->iimg),'eimg'=>json_decode($data->ext)]);

    }


    function transmissionJson(){
             $data = DB::table('car_transmission')->where('is_delete',0)->get(['id', 'transmission as transmission']);
          return response()->json( ['transmission'=>$data]);
    }


    function fuelJson(){
             $data = DB::table('car_fuel')->where('is_delete',0)->get(['id', 'fuel as fuel']);
          return response()->json( ['fuel'=>$data]);
    }

   function table_list(){

   //   $data = Make::where('is_delete',0)->get(['id', 'make as make','logo as image']);


      $data = 
      Listing::select('cars.title','car_listing.id as id','car_make.make','car_model.model','cars.is_enabled as status','car_listing.created_at as publish','car_types.type')
      ->join('cars','cars.id','=','car_listing.cars_id')
      ->join('car_types','car_types.id','=','car_listing.car_type_id')
      ->leftjoin('car_model','car_model.id','=','car_listing.car_model_id')
      ->leftjoin('car_make','car_make.id','=','car_model.car_make_id')
      ->get();

   return Datatables::of($data)
                ->rawColumns(['action','model','status'])
                ->addColumn('model',  function ($data) {
                   return $data->make."-".$data->model;
                 })
                ->addColumn('status',function ($data)
{
                  return Helper::publishstatus($data->status);
}

                )

            ->addColumn('action', function ($data) {
                return '<a data-act="ajax-modal"  data-id="'.$data->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a> 
                <a data-act="ajax-modal-del" data-id="'.$data->id.'" class="btn btn-xs btn-danger" ><i class="glyphicon glyphicon-edit" ></i> Delete</a>';
            })
         ->editColumn('id', 'ID: {{$id}}')
        ->make(true);

    }

    function store(Request $request){
// return json_encode($request->features);

          if($request->hasFile('baseimage')) 
                {
                   $validator = Validator::make($request->all(), [
                  'baseimage' => 'image|mimes:jpg,jpeg,png|max:2000'],[
                  'baseimage.required' => 'Please upload an image',
                  'baseimage.mimes' => 'Only jpeg,png and bmp images are allowed',
                  'baseimage.max' => 'Sorry! Maximum allowed size for an image is 2MB',
                  ]);
                if($validator->fails()) 
                {
                  return response()->json(['errors'=>$validator->errors()->all()]);           
                }
            }

              if ($request->hasFile('eimage')) 
                {
                   $validator = Validator::make($request->all(), [
                  'eimage.*' => 'image|mimes:jpg,jpeg,png|max:2000'],[
                  'eimage.*.required' => 'Please upload an image',
                  'eimage.*.mimes' => 'Only jpeg,png and bmp images are allowed',
                  'eimage.*.max' => 'Sorry! Maximum allowed size for an image is 2MB',
                  ]);
                    if($validator->fails()) 
                    {
                      return response()->json(['errors'=>$validator->errors()->all()]);           
                    }

            }

              if ($request->hasFile('iimage')) 
                {
                   $validator = Validator::make($request->all(), [
                  'iimage.*' => 'image|mimes:jpg,jpeg,png|max:2000'],[
                  'iimage.*.required' => 'Please upload an image',
                  'iimage.*.mimes' => 'Only jpeg,png and bmp images are allowed',
                  'iimage.*.max' => 'Sorry! Maximum allowed size for an image is 2MB',
                  ]);
                    if($validator->fails()) 
                    {
                      return response()->json(['errors'=>$validator->errors()->all()]);           
                    }
            }

  
if(!$request->id){
           $validator = Validator::make($request->all(), [
                  'baseimage' => 'required|image|mimes:jpg,jpeg,png|max:2000',
                  'title' => 'required',
                  'features.*' => 'required',
                  'year' => 'required',
                  'fuel' => 'required|not_in:0',
                  'transmission' => 'required|not_in:0',
                  'type' => 'required',
                  'model' => 'required',
                  'make' => 'required',
                  'price' => 'numeric',
              ],[
                  'baseimage.required' => 'Please upload an image',
                  'baseimage.mimes' => 'Only jpeg,png and bmp images are allowed',
                  'baseimage.max' => 'Sorry! Maximum allowed size for an image is 2MB',

                  ]);

                if($validator->fails()) 
                {
                  return response()->json(['errors'=>$validator->errors()->all()]);           
                }
              }
              else{
                      $validator = Validator::make($request->all(), [
                
                  'title' => 'required',
                  'features.*' => 'required',
                  'year' => 'required',
                  'fuel' => 'required',
                  'transmission' => 'required',
                  'type' => 'required',
                  'model' => 'required',
                  'make' => 'required',


              ],[
                  'baseimage.required' => 'Please upload an image',
                  'baseimage.mimes' => 'Only jpeg,png and bmp images are allowed',
                  'baseimage.max' => 'Sorry! Maximum allowed size for an image is 2MB',

                  ]);

                if($validator->fails()) 
                {
                  return response()->json(['errors'=>$validator->errors()->all()]);           
                }
              }

    

            if($request->id)
            {
               $listing = Listing::find($request->id);
               $car = Cars::find($listing->cars_id);
            }else
            {
               $car = new Cars;
            }
//return json_encode($request->features);
            $car->title = $request->title;
            $car->specification = $request->spec;
            $car->features = json_encode($request->features);
            $car->is_enabled = (isset($request->status)  ? 1 : 0);
            $car->is_booked =  (isset($request->booked) ? 1 : 0); 
            $car->is_featured = (isset($request->featured)  ? 1 : 0); 
            $car->slug = str_slug($request->title);
            $car->save();


            // MultipleImages

            if($request->id){
                      $images = CarImage::find($listing->car_images_id);
                   //   return $images;
                      $iid = $images->car_images_id;
            }
            else{
                    $images = new CarImage;
                    $iid = "";
            }
          if ($request->hasFile('baseimage')) 
                {
    
                $photo = $request->file('baseimage');
                $path = public_path('images/listing/base');
                $size = "500,500";
                $image  = Helper::ImageUpload($photo,$path,$size);


          Image::make($photo)->resize(262, 197)->save( public_path('images/listing/base/thumb/' .$image) );

                $images->base = $image ;





             }

              if ($request->hasFile('iimage')) 
                {
                $photo = $request->file('iimage');
                $path = public_path('images/listing/interior');
                $id= $iid;
                $column = "interior";
                      return Helper::MultipleImages($photo,$path,$id,$column);
                $images->interior =  Helper::MultipleImages($photo,$path,$id,$column);

               }

               if ($request->hasFile('eimage')) 
                {
                $photo = $request->file('eimage');
                $path = public_path('images/listing/exterior');
                $id= $iid;
                $column = "exterior";
                $images->exterior = Helper::MultipleImages($photo,$path,$id,$column);
              }
              if($request->hasFile('baseimage') || $request->hasFile('iimage') || $request->hasFile('eimage')){

              $images->save();
}

if(!$request->id){
        $listing = new Listing;
      }
      $listing->register_year =  $request->register_year;
      $listing->km_driven = $request->driven;
      $listing->model_year = $request->year;
      $listing->price =  $request->price;
      $listing->color =  $request->color;
      $listing->owners =  $request->owners;
      $listing->exterior =  $request->exterior;
      $listing->interior = $request->interior;
      $listing->insurance = $request->insurance;
      $listing->life_time_tax = $request->life_time_tax;

      $listing->car_fuel_id =  $request->fuel;
      if(isset($images->id)){
              $listing->car_images_id = $images->id;

      }
      if(isset($car->id)){
      $listing->cars_id = $car->id;
}
      $listing->car_transmission_id = $request->transmission;
      $listing->car_model_id =  $request->model;
      $listing->car_type_id = $request->type;
 
      $listing->save();
        return response()->json(['success'=>'Data Recorded']);              


    }


}
