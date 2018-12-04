<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Repositories\NewsletterSignupRepository;
use Illuminate\Http\Request;
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
    public function store(Request $request){
        $data =[
            'email'=> $request->input('email'),
            'status'=> 1,
        ];
        if($this->repository->create($data)){
            return Response::json(array('success' => true, 'msg' => 'Newsletter signup created successfully'), 200);
        }else{
            return Response::json(array('success' => false, 'msg' => 'Newsletter signup creation failed'), 422);
        }
    }
}
