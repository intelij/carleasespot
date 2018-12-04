<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\InquiryRepository;
class InquiryController extends Controller
{
    private $repository;
    public function __construct(InquiryRepository $repository)
    {
        $this->repository = $repository;
    }
    public function show($uuid){
        $inquiry = $this->repository->find($uuid);
        return view('frontend.inquiries.show', compact('inquiry'));
    }
    public function dealer_inquiries(){
        $user = auth()->guard('web')->user();
        $inquiries = $user->inquiries;
        return view('frontend.inquiries.index', compact('inquiries'));
    }
}
