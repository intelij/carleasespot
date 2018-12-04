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
class PoliciesController extends Controller
{
    public function index(){
        $policies=  DB::table('policies')->where('status','1')->paginate(10);

       return view('backend.policies.index',compact('policies'));
    }
 public function archive(){

        $policies=  DB::table('policies')->where('status','0')->paginate(10);

       return view('backend.policies.index',compact('policies'));
    }
    public function create(){
   
        return view('backend.policies.create');
    }
     public function store(Request $req){
        $this->validate($req, [
            'terms' => 'required',

        ]);


         DB::table('policies')->insert([
            'terms' => $req->terms,
            'status' => '1',
        ]);
        return redirect('admin/policies');
    }

    public function edit($id){
        $policies= DB::table('policies')->where('id',$id)->first();

       return view('backend.policies.create',compact('policies'));
    }
     public function update($id,Request $req){

         $this->validate($req, [
            'terms' => 'required',

        ]);
         DB::table('policies')->where('id',$id)->update(['terms' => $req->terms]);

       return redirect('admin/policies');
    }

     public function destroy($id)
	{
		
        DB::table('policies')->where('id',$id)->update(['status'=>'0']) ;
       return redirect()->back();

    }

}
