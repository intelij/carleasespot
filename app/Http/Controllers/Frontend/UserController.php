<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFrmRequest;
use App\Repositories\UserRepository;
use Image;
use File;
use Session;
use Response;
use DB;
class UserController extends Controller
{
    private $repository;
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index()
    {
        return view('backend.users.index');
    }
    public function profile(){
        $user = $this->repository->find(auth()->guard('web')->user()->uuid);
        	$ratings=DB::table('dealer_ratings')->where('dealer_id','=',$user)->get();
		$stars=$ratings->pluck('ratings')->toArray();
	
		if(count($ratings)>0)
		{
			$avg_rating=array_sum($stars)/count($stars);
		}
		else
		{
			$avg_rating=0;
		}
        return view('frontend.users.profile',compact('user','avg_rating'));
    }
    public function get_update_profile(){
        $user = $this->repository->find(auth()->guard('web')->user()->uuid);
        return view('frontend.users.user_details',compact('user'));
    }
    public function show(){
        $user = $this->repository->find(auth()->guard('web')->user()->uuid);
        return view('frontend.users.show',compact('user'));
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
    public function get_profile($id){
        $user = $this->repository->find($id);
		$ratings=DB::table('dealer_ratings')->where('dealer_id','=',$id)->get();
		$stars=$ratings->pluck('ratings')->toArray();
	
		if(count($ratings)>0)
		{
			$avg_rating=array_sum($stars)/count($stars);
		}
		else
		{
			$avg_rating=0;
		}
		foreach($ratings as $rating)
		{
		   $users[$rating->customers_id] = $this->repository->find($rating->customers_id);
		}
        return view('frontend.users.profile',compact('user','avg_rating','ratings','users'));
    }
}