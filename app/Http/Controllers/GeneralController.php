<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Entities\VehicleMake;
use App\Entities\VehicleModel;
use App\Repositories\ListingRepository;
use App\Repositories\CarImageRepository;
use App\Model\CarTrim;
use App\Model\CarMake;
use App\Model\CarModel;
use App\Model\CarType;
use App\Model\Listings;
use App\Model\States;
use App\Model\CarColor;
use Redirect;
use DB;
use Illuminate\Support\Facades\Input;
class GeneralController extends Controller
{
      public function __construct(ListingRepository $repository,CarImageRepository $car_image_repository)
	 {
		 $this->repository = $repository;
		  $this->car_image_repository = $car_image_repository;
	 }
    
     public function search(){
    	$make = Input::get('make')? Input::get('make') : '';
    	$model = Input::get('model')? Input::get('model'): '';
    	$year = Input::get('year')? Input::get('year'): '';
    	$trim = Input::get('trim')? Input::get('trim'): '';
    	$body_type = Input::get('body_type')? Input::get('body_type'): '';
    	$name = Input::get('name')? Input::get('name'): '';
    	$make_name = Input::get('make_name')? Input::get('make_name'): '';
    	$ad_title = Input::get('search_key')? Input::get('search_key'): '';

		$makedetails =  '';
		if($make != ''){
			$makedetails = CarMake::getMakeByID($make);
		}
		if($make != '' && $model == ''){
			return $this->modelShow($make, $year);
		}
		if($make != '' && $model != '' && $trim == ''){
			return $this->trimShow($model, $body_type, $year);
		}
		if($make != '' && $model != '' && $trim != ''){
			$model_info = CarModel::getModelByID($model);
			$makedetails =  '';
			$makedetails = CarMake::getMakeByID($model_info->id_car_make);
			$car_type = '';
			if($body_type){
				$car_type_info = CarType::getCarTypeByID($body_type);
				$car_type = $car_type_info->name;
			}

			//$cars = CarTrim::getAllTrimsFullinfo($model_info->id_car_make, $id_car_model, '', $id_car_type, '');
			$cars = Listings::getListingFullInfo($model, $trim, $body_type, '', $year);
			$makes_arr = CarMake::getAllMakes();
	        $makes = array();
	        $makes[''] = 'Select Option';
	        foreach($makes_arr as $make){
	            $makes[$make->id_car_make] = $make->name;
	        }
			return view('frontend.search.index',["cars"=>$cars , 'makedetails' => $makedetails, 'modeldetail' => $model_info, 'car_type' => $car_type, "makes"=>$makes, "year" => $year]);
		}
		// $cars = CarTrim::getAllTrimsFullinfo($make, $model, $trim, $body_type, $ad_title);
		// $makes_arr = CarMake::getAllMakes();
  //       $makes = array();
  //       $makes[''] = 'Select Option';
  //       foreach($makes_arr as $make){
  //           $makes[$make->id_car_make] = $make->name;
  //       }
    	
		// return view('frontend.search.index',["cars"=>$cars , 'makedetails' => $makedetails, "makes"=>$makes]);
    	
    }
    public function modelwithCarType($id_car_type){
    	$models = CarTrim::getAllModelwithTrimByType($id_car_type);
    	foreach($models as $key => $model){
    		$trims = CarTrim::getAllTrimsFullinfo('', $model->id_car_model, '', $id_car_type);
    		$highlights = array();
    		$min_mpg = 99999;
	    	$max_mpg = 0;
	    	$min_hp = 99999;
	    	$max_hp = 0;
	    	$min_seats = 99999;
	    	$max_seats = 0;
	    	$min_msrp = 999999;
	    	$max_msrp = 0;
	    	$i = 0;
	    	if(count($trims) == 0){
	    		continue;
	    	}
    		foreach($trims as $k => $trim){
    			if((int)$trim->id_car_type == (int)$id_car_type){
    				$flag = 1;
    				$hp = (int)substr($trim->horsepower, 0, strpos($trim->horsepower,'hp')-1);
	    			if((int)$trim->mileage > $max_mpg){
	    				$max_mpg = (int)$trim->mileage;
	    			}
	    			if((int)$trim->mileage < $min_mpg){
	    				$min_mpg = (int)$trim->mileage;
	    			}
	    			if($hp > $max_hp){
	    				$max_hp = $hp;
	    			}
	    			if($hp < $min_hp){
	    				$min_hp = $hp;
	    			}
	    			if((int)$trim->passenger_capacity > $max_seats){
	    				$max_seats = (int)$trim->passenger_capacity;
	    			}
	    			if((int)$trim->passenger_capacity < $min_seats){
	    				$min_seats = (int)$trim->passenger_capacity;
	    			}
	    			if((int)$trim->base_price > $max_msrp){
	    				$max_msrp = (int)$trim->base_price;
	    			}
	    			if((int)$trim->base_price < $min_msrp){
	    				$min_msrp = (int)$trim->base_price;
	    			}
	    			$highlight = explode(',', $trim->comfort_convenience_options);
	    			if($i < 5){
	    				foreach($highlight as $info){
		    				if($i < 5){
		    					array_push($highlights, $info);
		    					$i++;
		    				}
		    			}
	    			}
    			}
    		}
    		$models[$key]->min_mpg = ($min_mpg==0 || $min_mpg >= 99999)? 'N/A': $min_mpg;
    		$models[$key]->max_mpg = ($max_mpg==0 || $max_mpg >= 99999)? 'N/A': $max_mpg;
    		$models[$key]->min_hp = ($min_hp==0 || $min_hp >= 99999)? 'N/A': $min_hp;
    		$models[$key]->max_hp = ($max_hp==0 || $max_hp >= 99999)? 'N/A': $max_hp;
    		$models[$key]->min_seats = ($min_seats==0 || $min_seats >= 99999)? 'N/A': $min_seats;
    		$models[$key]->max_seats = ($max_seats==0 || $max_seats >= 99999)? 'N/A': $max_seats;
    		$models[$key]->highlights = $highlights;
    		$models[$key]->min_msrp = ($min_msrp==0 || $min_msrp >= 999999)? 'N/A': $min_msrp;
    		$models[$key]->max_msrp = ($max_msrp==0 || $max_msrp >= 999999)? 'N/A': $max_msrp;
    		$models[$key]->make_name = $trims[0]->make_name;
    		$models[$key]->id_car_type = $id_car_type;
    	}
    	$makes_arr = CarMake::getAllMakes();
        $makes = array();
        $makes[''] = 'Select Option';
        foreach($makes_arr as $make){
            $makes[$make->id_car_make] = $make->name;
        }
    	return view('frontend.search.models',["models"=>$models , "makes"=>$makes,'id_car_make'=>$id_car_type]);
    }
    public function modelShow($id_car_make, $year = ''){
    	$models = CarModel::getModelsByMake($id_car_make, $year);
    	foreach($models as $key => $model){
    		$trims = CarTrim::getAllTrimsFullinfo($id_car_make, $model->id_car_model);
    		$highlights = array();
    		$min_mpg = 99999;
	    	$max_mpg = 0;
	    	$min_hp = 99999;
	    	$max_hp = 0;
	    	$min_seats = 99999;
	    	$max_seats = 0;
	    	$min_msrp = 999999;
	    	$max_msrp = 0;
	    	$i = 0;
    		foreach($trims as $k => $trim){
    			$hp = (int)substr($trim->horsepower, 0, strpos($trim->horsepower,'hp')-1);

    			if((int)$trim->mileage > $max_mpg){
    				$max_mpg = (int)$trim->mileage;
    			}
    			if((int)$trim->mileage < $min_mpg){
    				$min_mpg = (int)$trim->mileage;
    			}
    			if($hp > $max_hp){
    				$max_hp = $hp;
    			}
    			if($hp < $min_hp){
    				$min_hp = $hp;
    			}
    			if((int)$trim->passenger_capacity > $max_seats){
    				$max_seats = (int)$trim->passenger_capacity;
    			}
    			if((int)$trim->passenger_capacity < $min_seats){
    				$min_seats = (int)$trim->passenger_capacity;
    			}
    			if((int)$trim->base_price > $max_msrp){
    				$max_msrp = (int)$trim->base_price;
    			}
    			if((int)$trim->base_price < $min_msrp){
    				$min_msrp = (int)$trim->base_price;
    			}
    			$highlight = explode(',', $trim->comfort_convenience_options);
    			if($i < 5){
    				foreach($highlight as $info){
	    				if($i < 5){
	    					array_push($highlights, $info);
	    					$i++;
	    				}
	    			}
    			}
    		}
    		$models[$key]->min_mpg = ($min_mpg==0 || $min_mpg >= 99999)? 'N/A': $min_mpg;
    		$models[$key]->max_mpg = ($max_mpg==0 || $max_mpg >= 99999)? 'N/A': $max_mpg;
    		$models[$key]->min_hp = ($min_hp==0 || $min_hp >= 99999)? 'N/A': $min_hp;
    		$models[$key]->max_hp = ($max_hp==0 || $max_hp >= 99999)? 'N/A': $max_hp;
    		$models[$key]->min_seats = ($min_seats==0 || $min_seats >= 99999)? 'N/A': $min_seats;
    		$models[$key]->max_seats = ($max_seats==0 || $max_seats >= 99999)? 'N/A': $max_seats;
    		$models[$key]->highlights = $highlights;
    		$models[$key]->min_msrp = ($min_msrp==0 || $min_msrp >= 999999)? 'N/A': $min_msrp;
    		$models[$key]->max_msrp = ($max_msrp==0 || $max_msrp >= 999999)? 'N/A': $max_msrp;
    	}
    	$makedetails = CarMake::getMakeByID($id_car_make);
    	$makes_arr = CarMake::getAllMakes();
        $makes = array();
        $makes[''] = 'Select Option';
        foreach($makes_arr as $make){
            $makes[$make->id_car_make] = $make->name;
        }
    	return view('frontend.search.models',["models"=>$models , 'makedetails' => $makedetails, "makes"=>$makes, "year" => $year,'id_car_make'=>$id_car_make]);
    }

    public function trimShow($id_car_model, $id_car_type = '', $year = ''){
    	$model_info = CarModel::getModelByID($id_car_model);
		$makedetails =  '';
		$makedetails = CarMake::getMakeByID($model_info->id_car_make);
		$car_type = '';
		if($id_car_type){
			$car_type_info = CarType::getCarTypeByID($id_car_type);
			$car_type = $car_type_info->name;
		}

		//$cars = CarTrim::getAllTrimsFullinfo($model_info->id_car_make, $id_car_model, '', $id_car_type, '');
		$cars = Listings::getListingFullInfo($id_car_model, '', $id_car_type, '', $year);
		$makes_arr = CarMake::getAllMakes();
        $makes = array();
        $makes[''] = 'Select Option';
        foreach($makes_arr as $make){
            $makes[$make->id_car_make] = $make->name;
        }
		return view('frontend.search.index',["cars"=>$cars , 'makedetails' => $makedetails, 'modeldetail' => $model_info, 'car_type' => $car_type, "makes"=>$makes, "year" => $year,'id_car_model'=>$id_car_model]);
    }


    public function detail(){
    	
    	$id_car_trim = Input::get('trim');

/*
        $car = VehicleMake::listing()->where('vehicle_makes.id_car_make',$make)->where('vehicle_models.id_car_model',$model)->addSelect('car_trim.id_car_serie')->where('car_trim.id_car_trim',$trim)->distinct('id_car_trim')->first();

        if($car){

        	$opt_ids = ["12493","24823","409","614","494","11773","22200","25930","110","8270","5880","6397","32051","6290","754","12491","16497","19417","22253","194","1571","1588","1694","16226"];

	        $options = DB::table('car_option')->select('car_option.name as option','car_option_value.is_base as value')->whereIn('car_option.id_car_option',$opt_ids)->join('car_option_value','car_option.id_car_option','=','car_option_value.id_car_option')->join('car_equipment','car_equipment.id_car_equipment','=',"car_option_value.id_car_equipment")->where('car_equipment.id_car_trim',$trim)->get();

	        $car->rear_view_camera ='';
			$car->power_window ='';
			$car->power_mirror ='';
			$car->power_lock ='';
			$car->navigation ='';
			$car->ac ='';
			$car->allow_rim ='';
			$car->fm_radio ='';
			$car->keyless_ignition ='';
			$car->power_steering ='';
			$car->fuel ='';
			$car->engine_type ='';
			$car->engine_power ='';
			$car->passenger_capacity ='';
			$car->capacity ='';

	  		foreach ($options as $option) {
	        	if($option->option == 'Rear view camera'){
	        		$car->rear_view_camera = $option->value;
	        	}else if($option->option == 'Power Windows'){
	        		$car->power_window = $option->value;
	        	}else if($option->option == 'Power folding mirrors'){
	        		$car->power_mirror = $option->value;
	        	}else if($option->option == 'Central locking'){
	        		$car->power_lock = $option->value;
	        	}else if($option->option == 'Navigation system'){
	        		$car->navigation = $option->value;
	        	}else if($option->option == 'Air conditioning'){
	        		$car->ac = $option->value;
	        	}else if (preg_match('/\bAlloy wheels\b/',$option->option)){

	        		$car->allow_rim = $option->value;
	        	}else if($option->option == 'AM/ FM radio'){
	        		$car->fm_radio = $option->value;
	        	}else if($option->option == 'push button ignition'){
	        		$car->keyless_ignition = $option->value;
	        	}else if($option->option == 'The power steering'){
	        		$car->power_steering = $option->value;
	        	}
	        	
	        }

	        $spe_ids = ["22","2","24","14","4","13"];
	        $specifications = DB::table('car_specification')->select('car_specification_value.value','car_specification_value.unit','car_specification.name as specifier')
	        	->whereIn('car_specification.id_car_specification',$spe_ids)
	        	->join('car_specification_value','car_specification.id_car_specification','=','car_specification_value.id_car_specification')
	        	->where('car_specification_value.id_car_trim',$trim)
	        	->orderBy('car_specification.id_parent')
	        	->get();
	        
	        foreach ($specifications as $specification) {
	        	if($specification->specifier == 'Fuel'){
	        		$car->fuel = $specification->value;
	        	}else if($specification->specifier == 'Gearbox type'){
	        		$car->gear_type = $specification->value;
	        	}else if($specification->specifier == 'Engine power'){
	        		$car->engine_power = $specification->value . ' ' .$specification->unit;
	        	}else if($specification->specifier == 'Number of seater'){
	        		$car->passenger_capacity = $specification->value . ' ' .$specification->unit;
	        	}else if($specification->specifier == 'Capacity'){
	        		$car->capacity = $specification->value . ' ' .$specification->unit;
	        	}

	        	
	        }
	        
	        $car->specifications = $specifications;

	        
        }
        $model_id=DB::table('vehicle_models')->where('id_car_model',$model)->pluck('uuid')->first();
         $make_id=DB::table('vehicle_makes')->where('id_car_make',$make)->pluck('uuid')->first();
  	*/
        $car = CarTrim::getAllTrimsFullinfo('','',$id_car_trim);

        $input_featured = 0;
        if(Input::has('featured')){
        	if(Input::get('featured')){
        		$input_featured = 1;
        	}
        }
    	$ex_colors = $car[0]->exterior_color;
		$ext_colors = array();
		if($ex_colors){
			$ex_colors_arr = explode(',', $ex_colors);
			foreach($ex_colors_arr as $id){
				$color_info = CarColor::getColorInfoByID($id);
				$ext_colors[] = $color_info;
			}
		}else{
			$ext_colors = 'N/A';
		}
		$car[0]->ext_colors = $ext_colors;
		$in_colors = $car[0]->interior_color;
		$int_colors = array();
		if($in_colors){
			$in_colors_arr = explode(',', $in_colors);
			foreach($in_colors_arr as $id){
				$color_info = CarColor::getColorInfoByID($id);
				$int_colors[] = $color_info;
			}
		}else{
			$int_colors = 'N/A';
		}
		$car[0]->int_colors = $int_colors;
		if($input_featured == 1){
			$listings = Listings::getListing($id_car_trim, $input_featured);	
		}else{
			$listings = Listings::getListing($id_car_trim);	
		}
        
        $make_id = $car[0]->id_car_make;
        $model_id = $car[0]->id_car_model;

		$top_listings=array();
		$similar_listings=array();
		$featured = 0;
		$min_price = 0;
		$max_price = 0;
		$min_sell_price = 0;
		$max_sell_price = 0;
		$count_dealer = count($listings);
		if($count_dealer > 0){
			$lowest_dealer = $listings[0];
		}
		foreach($listings as $listing)
		{

			$state = $listing->state;
			
        	$states = '';
        	if($state == '1'){
        		$states = 'All States';
        	}else{
        		$state_arr = explode(',', $state);
        		$i =0;
        		foreach($state_arr as $id){
        			$state_info = States::getStateInfoByID($id);
        			if($i == 0){
        				$states = $state_info->short_name;
        			}elseif($i == 2 && count($state_arr) > 3){
        				$states = ', '.$state_info->short_name.',';
        			}elseif($i == 3){
        				$states .= '<br/>'.$state_info->short_name;	
        			}else{
        				$states .= ', '.$state_info->short_name;	
        			}
        			$i++;
        		}
        	}
        	$listing->states = $states;

			if($listing->top==1)
			{
				$top_listings[]=$listing;
			}
			else
			{
				$similar_listings[]=$listing;
			}
			if($listing->featured == 1){
				$featured = 1;
			}
			$min_price = $listing->min_price;
			$min_sell_price = $listing->min_sell_price;
			$max_price = $listing->max_price;
			$max_sell_price = $listing->max_sell_price;
			$ratings[$listing->dealer_id]=DB::table('dealer_ratings')->select('dealer_ratings.ratings')->where('dealer_id','=',$listing->dealer_id)->get();
		}
		
		if(count($ratings)>0)
		{
			$avg_rating=array_sum($ratings)/count($ratings);
		}
		else
		{
			$avg_rating=0;
		}
        $car->images = DB::table('car_images')->where('make_id','=',$make_id)->where('model_id','=',$model_id)->get();

       	$featured_listings = Listings::getListingFullInfo('','','',1);
    	foreach($featured_listings as $count=>$featured_listing){
            $image = $this->car_image_repository->findWhere(['make_id'=>$featured_listing->id_car_make,'model_id'=>$featured_listing->id_car_model])->first();
            $featured_listings[$count]->image = asset($image ? 'assets/car_images/'.$image->make_id.$image->model_id.'/'.$image->file_name : 'assets/car_images/no-image.png');
        }

        return view('detail',["car"=>$car[0], "featured" => $featured, "top_listings"=>$top_listings,"similar_listings"=>$similar_listings, 'lowest_dealer' => $lowest_dealer, "avg_rating"=>$avg_rating, "featured_listings"=>$featured_listings, 'min_price'=>$min_price, 'min_sell_price' => $min_sell_price, 'max_price' => $max_price, 'max_sell_price' => $max_sell_price, 'count_dealer' => $count_dealer]);
    }
     public function terms()
     {
     	$terms=  DB::table('terms')->where('status','1')->get();

       	return view('frontend.terms.terms',compact('terms'));

     }
public function policies()
    {

		$policies=  DB::table('policies')->where('status','1')->get();

		return view('frontend.policies.terms',compact('policies'));

    }
    public function comparison(){
        
        $makemode = VehicleMake::select(
            'vehicle_makes.name',
            'car_model.name',
            'car_make.name',
            'car_trim.id_car_trim',
            'car_make.id_car_make',
            'car_model.id_car_model'
            )
            ->leftJoin('car_make','vehicle_makes.id_car_make','=','car_make.id_car_make')
            ->leftJoin('car_trim','car_make.id_car_make','=','car_trim.id_car_make')
            ->leftJoin('car_model','car_trim.id_car_model','=','car_model.id_car_model')
            ->groupBy('car_trim.id_car_trim')
            ->get();
        return view('frontend.comparison.index', compact("makemode"));
    }
}
