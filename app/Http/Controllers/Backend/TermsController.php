<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\CarImageRepository;
use App\Repositories\VehicleMakeRepository;
use App\Repositories\VehicleModelRepository;
use Session;
use Response;
use Image;
use File;
use DB;
use Illuminate\Http\Request;
class TermsController extends Controller
{
    public function index(){
        $terms=  DB::table('terms')->where('status','1')->paginate(10);

       return view('backend.terms.index',compact('terms'));
    }
 public function archive(){
        $terms=  DB::table('terms')->where('status','0')->paginate(10);

       return view('backend.terms.index',compact('terms'));
    }
    public function create(){
   
        return view('backend.terms.create');
    }
     public function store(Request $req){
        $this->validate($req, [
            'terms' => 'required',

        ]);


         DB::table('terms')->insert([
            'terms' => $req->terms,
            'status' => '1',
        ]);
        return redirect('admin/terms');
    }

    public function edit($id){
        $terms= DB::table('terms')->where('id',$id)->first();

       return view('backend.terms.create',compact('terms'));
    }
    public function update($id,Request $req){

         $this->validate($req, [
            'terms' => 'required',

        ]);
        DB::table('terms')->where('id',$id)->update(['terms' => $req->terms]);

       return redirect('admin/terms');
    }

     public function destroy($id)
	{
		
        DB::table('terms')->where('id',$id)->update(['status'=>'0']) ;
       return redirect()->back();

    }

}
