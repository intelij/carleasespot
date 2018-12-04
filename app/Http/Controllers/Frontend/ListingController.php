<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\LeaseFrmRequest;
use App\Http\Requests\ListingFrmRequest;
use App\Mail\LeaseMail;
use App\Http\Controllers\Controller;
use App\Repositories\ListingRepository;
use App\Repositories\InquiryRepository;
use App\Repositories\VehicleMakeRepository;
use App\Repositories\CarImageRepository;
use App\Repositories\VehicleModelRepository;
use App\Model\CarMake;
use App\Model\CarModel;
use App\Model\CarTrim;
use App\Model\States;
use App\Model\Listings;
use Mail;
Use Response;
use Session;
use DB;
use Auth;
use Request;

use Illuminate\Support\Facades\Input;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as Xlsx;
use \PhpOffice\PhpSpreadsheet\IOFactory as IOFactory;

class ListingController extends Controller
{
    private $repository,$inquiry_repository,$make_repository,$car_image_repository,$model_repository;
    public function __construct(ListingRepository $repository,CarImageRepository $car_image_repository,InquiryRepository $inquiry_repository, VehicleMakeRepository $make_repository,VehicleModelRepository $model_repository)
    {
        $this->repository = $repository;
        $this->inquiry_repository = $inquiry_repository;
        $this->make_repository = $make_repository;
        $this->car_image_repository = $car_image_repository;
        $this->model_repository = $model_repository;
    }
    public function index(){
        $user = auth()->guard('web')->user()->uuid;
        $listings = Listings::indexlisting($user);
        
        return view('frontend.listings.index', compact('listings'));
    }
    public function create(){
        $makes_arr = CarMake::getAllMakes();
        $makes = array();
        $makes[''] = 'Select Option';
        foreach($makes_arr as $make){
            $makes[$make->id_car_make] = $make->name;
        }
        $states_arr = States::getAllStates();
        $states = array();
        foreach($states_arr as $state){
            $states[$state->id] = $state->state;
        }
        return view('frontend.listings.create',compact('makes', 'states'));
    }
    public function store(ListingFrmRequest $request){
        $user = auth()->guard('web')->user()->uuid;
          if(count($request->state)>6)
         {
            Session::flash('error','select only 6 states or select all states');
            return redirect()->route('listings.create');   
         }
         $listing = Listings::getExistListing($user, $request->trim);
         if($listing){
            Session::flash('error','You have been created already.');
            return redirect()->route('listings.create');
         }
         
         $car_info = CarTrim::getTrimByID($request->trim);
        $data = [
            'year' => $request->year,
            'id_car_make' => $request->make,
            'id_car_model' => $request->model,
            'id_car_trim' => $request->trim,
            'id_car_type' => $car_info->id_car_type,
            'price' => $request->price,
            'sell_price' => $request->sell_price,
            'down_payment' => floatval(str_replace(',','',$request->down_payment)),
            'mileage' => floatval(str_replace(',','',$request->mileage)),
            'type' => $request->type,
            'state' => implode(',', $request->state),
            'terms'=>$request->terms,
            'dealer_id'=>$user
        ];
        $exist_listing = Listings::exist_listing($user, $request->trim);
        if(count($exist_listing) > 0){
            Session::flash('error','This listing is exist in DB already.');
            return redirect()->route('listings.create');
        }
        if(Listings::insertListing($data)){
            Session::flash('success','Listing created successfully');
            return redirect()->route('listings.create');
        }else{
            Session::flash('error','Listing creation failed');
            return redirect()->route('listings.create');
        }
    }
public function getmodels($data)
	{
		$models=DB::table('vehicle_models')->where('name','=',$data)->get();
		foreach($models as $model)
		{
			$st[$model->id]=$model->name;
		}
		
		return response()->json($st);
	}
    public function get_states($data)
	{
		$states=DB::table('states')->where('state','like',$data.'%')->get();
		foreach($states as $state)
		{
			$st[$state->id]=$state->state;
		}
		
		return response()->json($st);
	}
    public function edit($uuid){
        $listing = Listings::getListingByID($uuid);
        $makes_arr = CarMake::getAllMakes();
        $makes = array();
        $makes[''] = 'Select Option';
        foreach($makes_arr as $make){
            $makes[$make->id_car_make] = $make->name;
        }

        $models_arr = CarModel::getModelsByMake($listing->id_car_make, $listing->year);
        $mdoels = array();
        $models[''] = 'Select Option';
        foreach($models_arr as $model){
            $models[$model->id_car_model] = $model->name;
        }

        $trims_arr = CarTrim::getTrimsByModelID($listing->id_car_model, $listing->year);
        $trims = array();
        $trims[''] = 'Select Option';
        foreach($trims_arr as $trim){
            $trims[$trim->id_car_trim] = $trim->style_name;
        }

        $states_arr = States::getAllStates();
        $states = array();
        foreach($states_arr as $state){
            $states[$state->id] = $state->state;
        }

        return view('frontend.listings.edit',compact('makes','listing','models', 'trims', 'states'));
    }
    public function update(ListingFrmRequest $request,$uuid){
        $user = auth()->guard('web')->user()->uuid;
        $data = [
            'make_id' => $request->make,
            'model_id' => $request->model,
            'price' => $request->price,
            'sell_price' => $request->sell_price,
            'down_payment' => $request->down_payment,
            'mileage' => $request->mileage,
            'type' => $request->type,
            'year' => $request->year,
            'color' => $request->color,
            'state' => $request->state,
            'terms'=>$request->terms,
            'dealer_id'=>$user
        ];
        if($this->repository->update($data,$uuid)){
            Session::flash('success','Listing updated successfully');
            return redirect()->route('listings.edit',$uuid);
        }else{
            Session::flash('error','Listing update failed');
            return redirect()->route('listings.edit',$uuid);
        }
    }
    public function show($uuid){
         $listing = $this->repository->find($uuid);
        $listing->images = $this->car_image_repository->findWhere(['make_id'=>$listing->make_id,'model_id'=>$listing->model_id]);
		$highest_listing = $this->repository->orderBy('price','desc')->findWhere(['make_id'=>$listing->make_id,'model_id'=>$listing->model_id])->first();
		$lowest_listing = $this->repository->orderBy('price','asc')->findWhere(['make_id'=>$listing->make_id,'model_id'=>$listing->model_id])->first();    
		$dealer_listings = $this->repository->orderBy('price','asc')->findWhere(['make_id'=>$listing->make_id,'model_id'=>$listing->model_id]);
		$ratings=DB::table('dealer_ratings')->select('dealer_ratings.ratings')->where('dealer_id','=',$listing->dealer->uuid)->get();
		$stars=$ratings->pluck('ratings')->toArray();
		if(count($ratings)>0)
		{
			$avg_rating=array_sum($stars)/count($stars);
		}
		else
		{
			$avg_rating=0;
		}
               if(Auth::check())
		{
			if(!empty(auth()->guard('web')->user()))
			{
				$uuid=auth()->guard('web')->user()->uuid;
			}
			else
			{
				$uuid=auth()->guard('api')->user()->uuid;
			}
			$favorites=DB::table('make_favorites')->where('listing_id',$uuid)->where('dealer_id',$uuid)->first();
		}
		else
		{
			$favorites='';
		}
        $featured_listings = $this->repository->findWhere(['featured'=>1]);
        foreach($featured_listings as $count=>$featured_listing){
            $image = $this->car_image_repository->findWhere(['make_id'=>$featured_listing->make_id,'model_id'=>$featured_listing->model_id])->first();
            $featured_listings[$count]->image = asset($image ? 'assets/car_images/'.$image->make_id.$image->model_id.'/'.$image->file_name : 'assets/car_images/no-image.png');
        }

        return view('frontend.listings.show',compact('listing','featured_listings','highest_listing','lowest_listing','dealer_listings','avg_rating'));
    }
    public function get_lease($id){
        $type = 0;
        $listing = Listings::getListingByID($id);
        return view('frontend.listings.lease',compact('type','listing'));
    }
     public function get_review($uuid){
         if(auth()->guard('web')->user())
         {
             $type = 0;
             $id=auth()->guard('web')->user()->uuid;
             $listing = $this->repository->find($uuid);
            return view('frontend.listings.review',compact('type','listing','id'));
         }
         else 
         {
              $id=auth()->guard('api')->user()->uuid;
             $listing = $this->repository->find($uuid);
            return view('frontend.listings.review',compact('type','listing','id'));
         }
    }
	public function post_review(Request $request){
		$req=Request::all();
		DB::table('dealer_ratings')->insert(['dealer_id'=>$req["listing"],
		'ratings'=>$req["rating"],
		'reviews'=>$req["review"],
		'customers_id'=>$req["user"]]);
		return redirect()->back();
	}
    public function get_buy($id){
        $type = 1;
        $listing = Listings::getListingByID($id);
        return view('frontend.listings.lease',compact('type','listing'));
    }
    public function post_lease(LeaseFrmRequest $request){
        $listing = Listings::getListingByID($request->listing);
        if($request->type == 0){
            $price = $listing->price;
        }else{
            if($listing->type == 1){
                $price = $listing->price;
            }else{
                $price = $listing->sell_price;
            }
        }
        $data = [
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'message'=>$request->message,
            'listing_id' => $listing->id,
            'dealer_id'=>$listing->dealer_id,
            'car'=>$listing->year.' '.$listing->make_name.' '.$listing->model_name.' '.$listing->trim_style_name,
            'ip_address'=>$request->ip_address,
            'type'=>$request->type,
            'price'=>'$'.$price,
        ];
        $inquiry = $this->inquiry_repository->create($data);
        Mail::to($listing->email)->bcc('dealerleads@carleasespot.com')->send(new LeaseMail($inquiry));
        //Mail::to($listing->dealer->email)->cc('joasoussan@gmail.com')->bcc('sammkaranja@gmail.com')->send(new LeaseMail($inquiry));
        if(count(Mail::failures()) > 0){
            return Response::json(array('success' => false, 'msg' => 'Sorry we are unable to send your request at the moment.'), 422);
        }else{
            return Response::json(array('success' => true, 'msg' => 'Thank you for contacting us, we will get back to you as soon as possible.'), 200);
        }
    }
        public function list_favorite(){
              if(!empty(auth()->guard('api')->user()))
		{
		      $uuid=auth()->guard('api')->user()->uuid;
                        $listing_id = Request::input('key');
			$check=DB::table('make_favorites')->where('dealer_id','=',$uuid)->where('listing_id','=',$listing_id)->get();
			
			if(count($check)>0)
			{

				DB::table('make_favorites')->where('dealer_id','=',$uuid)->where('listing_id','=',$listing_id)->delete();
				return Response::json(2);
			}
			else
			{
			 
				DB::table('make_favorites')->insert([
				'dealer_id'=> $uuid,
				'listing_id'=>$listing_id
				]);
			    return Response::json(1);die;
			}
		}

		else
		{
			return Response::json(0);
		}

    }

    public function dealer_featured_listings(){
        $user = auth()->guard('web')->user()->uuid;
        $listings = Listings::featuredlisting($user);
        return view('frontend.listings.featured', compact('listings'));
    }
    public function dealer_inactive_listings(){
        $user = auth()->guard('web')->user()->uuid;
        $listings = Listings::inactivelisting($user);
        return view('frontend.listings.inactive', compact('listings'));
    }
    public function destroy($uuid){
        if($this->repository->update(['status'=>0],$uuid)){
            Session::flash('success','Listing deleted successfully');
        }else{
            Session::flash('error','Listing deletion failed');
        }
        return redirect()->route('profile');
    }

    public function upload_excel(){
        $user = Auth::user();
        $dealer_id = $user->uuid;
        if(Input::hasFile('file')){
            $destinationPath = base_path().'/assets/upload_excel';
            $extension = Input::file('file')->getClientOriginalExtension();
            $fileName = uniqid().'.'.$extension;
            Input::file('file')->move($destinationPath, $fileName);

            $spreadsheet = IOFactory::load($destinationPath.'/'.$fileName);
            $activesheet = $spreadsheet->getActiveSheet();
            $highest_row = $activesheet->getHighestRow();
            $highest_column = $activesheet->getHighestColumn();
            $msg = array();
            $total = 0;
            for($row = 2; $row <= $highest_row; $row++){
                $error_msg = array();
                $rowData = $activesheet->rangeToArray('A' . $row . ':' . $highest_column . $row,
                                    NULL,
                                    TRUE,
                                    FALSE);
                $rowData = $rowData[0];
                if($rowData[5] !== NULL){
                    $trim_info = CarTrim::getTrimByStyleID($rowData[5]);
                    if(!$trim_info){
                        $error_msg[] = $row.' Row Style_id '.$rowData[5].' is not exist.';
                    }
                }else{
                    $error_msg[] = $row.' Row Style_id is Null.';
                }
                if($rowData[7] === NULL && $rowData[8] === NULL){
                    $error_msg[] = $row.' Row Lease Price and Buy Price are Null.';
                }
                if($rowData[10] === NULL){
                    $error_msg[] = $row.' Row Down Payment is Null.';
                }
                if($rowData[11] === NULL){
                    $error_msg[] = $row.' Row Mileage is Null.';
                }
                if($rowData[12] === NULL){
                    $state = "1";
                }else{
                    $states = explode(',', $rowData[12]);
                    $state = '';
                    $i = 0;
                    if(count($states) > 0){
                        foreach($states as $state_name){
                            if(strlen($state_name) >2){
                                $state_name = ucwords($state_name);
                            }else{
                                $state_name = strtoupper($state_name);
                            }
                            $sinfo = States::getStateInfoByName($state_name);
                            if($i == 0){
                                $state .= $sinfo->id;
                            }else{
                                $state .= $sinfo->id.',';
                            }
                            $i++;
                        }
                    }
                }
                $type = 0;
                if($rowData[7] !== NULL && $rowData[8] !== NULL){
                    $type = 2;
                }elseif($rowData[7] === NULL && $rowData[8] !== NULL){
                    $type = 1;
                }
                $exist_listing = Listings::exist_listing($dealer_id, $id_car_trim);
                if(count($exist_listing) > 0){
                    $error_msg[] = $row.' is exist in DB.';
                }
                if(count($error_msg) == 0){
                    $data = array(
                        'year' => $trim_info->year,
                        'id_car_make' => $trim_info->id_car_make,
                        'id_car_model' => $trim_info->id_car_model,
                        'id_car_trim' => $trim_info->id_car_model,
                        'id_car_type' => $trim_info->id_car_type,
                        'dealer_id' => $dealer_id,
                        'terms' => intVal($rowData[9]),
                        'price' => floatVal($rowData[7]),
                        'sell_price' => floatVal($rowData[8]),
                        'type' => $type,
                        'down_payment' => floatVal($rowData[10]),
                        'mileage' => intVal($rowData[11]),
                        'state' => $state
                    );
                    
                    $id = Listings::insertListing($data);
                    $msg['success'][] = $row;
                    $total++;
                }else{
                    $msg['err'][] = $error_msg;
                }
            }
            return json_encode(array('msg' => $msg, 'total' => $total));
        }
    }
}
