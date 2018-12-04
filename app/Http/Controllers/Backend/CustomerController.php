<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFrmRequest;
use App\Repositories\UserRepository;
use Session;
use Response;
use Request;
use DB;
use Mail;
use App\Mail\ActivationMail;
class CustomerController extends Controller
{
    private $repository;
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index()
    {
        $customers = $this->repository->findWhere(['status'=>'1','type'=>'customer']);
        return view('backend.customers.index',compact('customers'));
    }
    public function create(){
        return view('backend.customer.create');
    }
    public function edit($uuid){
        $dealer = $this->repository->find($uuid);
        return view('backend.customers.edit', compact('dealer'));
    }
    public function store(UserFrmRequest $request){
        $data =[
            'name'=> $request->get('name'),
            'email'=> $request->get('email'),
            'password'=> bcrypt($request->password),
            'status'=> $request->get('status'),
        ];
        if($this->repository->create($data)){
            Session::flash('success','Dealer created successfully');
            return Response::json(array('success' => true, 'msg' => 'Dealer created successfully'), 200);
        }else{
            Session::flash('error','Dealer creation failed');
            return Response::json(array('success' => false, 'msg' => 'Dealer creation failed'), 422);
        }
    }
    public function update(UserFrmRequest $request,$uuid){
        $data =[
            'name'=> $request->get('name'),
            'email'=> $request->get('email'),
            'status'=> $request->get('status'),
        ];
        if($request->password != ''){
            $data['password'] = bcrypt($request->password);
        }
        if($this->repository->update($data,$uuid)){
            Session::flash('success','Dealer updated successfully');
            return Response::json(array('success' => true, 'msg' => 'Dealer updated successfully'), 200);
        }else{
            Session::flash('error','Dealer update failed');
            return Response::json(array('success' => false, 'msg' => 'Dealer update failed'), 422);
        }
    }
    public function destroy($uuid){
        if($this->repository->delete($uuid)){
            Session::flash('success','Dealer deleted successfully');
        }else{
            Session::flash('error','Dealer deletion failed');
        }
        return redirect('admin/customers');
    }
    public function newcustomers()
    {
        $customers = $this->repository->findWhere(['status'=>'0','type'=>'customer']);
        return view('backend.customers.index',compact('customers'));
    }
    public function activate($uuid)
    {
        $customers = $this->repository->update(['status'=>'1'],$uuid);
         $dealer= $this->repository->find($uuid);
         if(!empty($dealer->activation_code))
        {
          Mail::to($dealer->email)->bcc('sammkaranja@gmail.com')->send(new ActivationMail($dealer));
         }
         else
         {
            $activation_code = str_random(30).time();
               $this->repository->update(['activation_code'=>$activation_code],$uuid);
               $activate= $this->repository->find($uuid);
 
              Mail::to($dealer->email)->bcc('sammkaranja@gmail.com')->send(new ActivationMail($activate));

         }
        return redirect()->back();
    }
   public function deactivate($uuid)
    {
        $customers = $this->repository->update(['status'=>'0'],$uuid);
        return redirect()->back();
    }
}
