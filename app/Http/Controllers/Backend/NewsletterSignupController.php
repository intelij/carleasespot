<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewsletterSignupFrmRequest;
use App\Repositories\NewsletterSignupRepository;
use Mail;
Use Response;
use Session;
class NewsletterSignupController extends Controller
{
    private $repository;
    public function __construct(NewsletterSignupRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index(){
        $newsletter_signups = $this->repository->all();
        return view('backend.newsletter_signups.index', compact('newsletter_signups'));
    }
    public function create(){
        return view('backend.newsletter_signups.create');
    }
    public function edit($uuid){
        $newsletter_signup = $this->repository->find($uuid);
        return view('backend.newsletter_signups.edit', compact('newsletter_signup'));
    }
    public function store(NewsletterSignupFrmRequest $request){
        $data =[
            'email'=> $request->get('email'),
            'status'=> $request->get('status'),
        ];
        if($this->repository->create($data)){
            Session::flash('success','Newsletter signup created successfully');
            return Response::json(array('success' => true, 'msg' => 'Newsletter signup created successfully'), 200);
        }else{
            Session::flash('error','Newsletter signup creation failed');
            return Response::json(array('success' => false, 'msg' => 'Newsletter signup creation failed'), 422);
        }
    }
    public function update(NewsletterSignupFrmRequest $request,$uuid){
        $data =[
            'email'=> $request->get('email'),
            'status'=> $request->get('status'),
        ];
        if($this->repository->update($data,$uuid)){
            Session::flash('success','Newsletter signup updated successfully');
            return Response::json(array('success' => true, 'msg' => 'Newsletter signup updated successfully'), 200);
        }else{
            Session::flash('error','Vehicle make update failed');
            return Response::json(array('success' => false, 'msg' => 'Newsletter signup update failed'), 422);
        }
    }
    public function destroy($uuid){
        if($this->repository->delete($uuid)){
            Session::flash('success','Newsletter signup deleted successfully');
        }else{
            Session::flash('error','Newsletter signup deletion failed');
        }
        return redirect()->route('admin.newsletter_signups.index');
    }
}
