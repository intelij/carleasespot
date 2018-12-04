<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminProfileFrmRequest;
use App\Repositories\AdminRepository;
use Auth;
use Image;
use Session;
class AdminController extends Controller
{
    private $repository;
    public function __construct(AdminRepository $repository)
    {
        $this->repository = $repository;
    }
    public function get_profile(){
        $user = $this->repository->find(Auth::guard('admin')->user()->uuid);
        return view('backend.profile.profile', compact('user'));
    }
    public function post_profile(AdminProfileFrmRequest $request){
        $uuid = Auth::guard('admin')->user()->uuid;
        $user = [
            'name'=>$request->name,
            'email'=>$request->email,
        ];
        if($request->password != ''){
            $user['password'] = bcrypt($request->password);
        }
        if ($request->hasFile('profile_photo')){
            $file = $request->file('profile_photo');
            $filename = strtolower(str_random(50) . '.' . $file->getClientOriginalExtension());
            $file->move('assets/user_files/admins/'.$uuid, $filename);
            Image::make(sprintf('assets/user_files/admins/'.$uuid.'/%s', $filename))->resize(300)->save();
            $user['photo']= $filename;
        }
        if($this->repository->update($user,$uuid)){
            Session::flash('success','Profile updated successfully');
        }else{
            Session::flash('error','Profile update failed');
        }
        return redirect()->route('admin_profile');
    }
}
