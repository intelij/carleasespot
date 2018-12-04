<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Repositories\InquiryRepository;
use Mail;
Use Response;
use Session;
use DB;
use Request;
class InquiryController extends Controller
{
    private $repository;
    public function __construct(InquiryRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index(){
        $inquiries = $this->repository->findWhere(['archive'=>'0']);
        return view('backend.inquiries.index', compact('inquiries'));
    }
	public function archive(){
        $inquiries = $this->repository->findWhere(['archive'=>'1']);;
        return view('backend.inquiries.index', compact('inquiries'));
    }
public function print($uuid)
	{
		 $inquiry = $this->repository->find($uuid);
        return view('backend.inquiries.print', compact('inquiry'));

	 }
   public function addarchive()
	{
		 $uuid = Request::input('key');
		DB::table('inquiries')->where('uuid',$uuid)->update(['archive'=>'1']);

	 }
    public function show($uuid){
        $inquiry = $this->repository->find($uuid);
        return view('backend.inquiries.show', compact('inquiry'));
    }
}
