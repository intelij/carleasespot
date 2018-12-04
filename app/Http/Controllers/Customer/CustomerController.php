<?php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFrmRequest;
use App\Repositories\ListingRepository;
use App\Repositories\UserRepository;
use App\Repositories\CarImageRepository;
use App\Repositories\VehicleMakeRepository;
use App\Repositories\VehicleModelRepository;
use Image;
use File;
use Session;
use Response;
use DB;
class CustomerController extends Controller
{
    private $repository,$listingrepository,$make_repository,$car_image_repository,$model_repository;
    public function __construct(UserRepository $repository,ListingRepository $listingrepository,CarImageRepository $car_image_repository,VehicleMakeRepository $make_repository,VehicleModelRepository $model_repository)
    {
        $this->repository = $repository;
        $this->listingrepository=$listingrepository;
         $this->car_image_repository = $car_image_repository;
           $this->make_repository = $make_repository;
        $this->car_image_repository = $car_image_repository;
        $this->model_repository = $model_repository;
    }
    public function index()
    {
        return view('backend.users.index');
    }
    public function profile(){
        $user = $this->repository->find(auth()->guard('api')->user()->uuid);
        return view('customer.profile',compact('user'));
    }
    public function get_update_profile(){
        $user = $this->repository->find(auth()->guard('api')->user()->uuid);
        return view('customer.user_details',compact('user'));
    }
    public function show(){
        $user = $this->repository->find(auth()->guard('api')->user()->uuid);
        return view('customer.show',compact('user'));
    }
    public function update(UserFrmRequest $request,$uuid){
        $user = $this->repository->find($uuid);
        $user_data = [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
        ];
        if ($request->hasFile('profile_photo')){
            $file = $request->file('profile_photo');
            $filename = strtolower(str_random(50) . '.' . $file->getClientOriginalExtension());
            $file->move('assets/user_files/'.$uuid, $filename);
            Image::make(sprintf('assets/user_files/'.$uuid.'/%s', $filename))->resize(200, 200)->save();
            File::delete('assets/user_files/'.$user->photo);
            $user_data['photo']= $filename;
        }
        if($this->repository->update($user_data,$uuid)){
            Session::flash('success','Profile updated successfully');
            return Response::json(array('success' => true, 'msg' => 'Profile updated successfully'), 200);
        }else{
            Session::flash('error','Profile  update failed');
            return Response::json(array('success' => false, 'msg' => 'Profile update failed'), 422);
        }
    }
	public function favorites(){
        $user = $this->repository->find(auth()->guard('api')->user()->uuid); 

        $favorites=DB::table('make_favorites')
        ->select('make_favorites.*','listings.*')
        ->leftJoin('listings','listings.uuid','=','make_favorites.listing_id')
        ->where('make_favorites.dealer_id','=',$user->uuid)->get();
        
           foreach($favorites as $count=>$favorite){
            $image = $this->car_image_repository->findWhere(['make_id'=>$favorite->make_id,'model_id'=>$favorite->model_id])->first();
            $favorites[$count]->image = asset($image ? 'assets/car_images/'.$image->make_id.$image->model_id.'/'.$image->file_name : 'assets/car_images/no-image.png');
            $favorites[$count]->listing=$this->listingrepository->find($favorite->uuid);
        }



        return view('customer.fav',compact('favorites'));
    }
}