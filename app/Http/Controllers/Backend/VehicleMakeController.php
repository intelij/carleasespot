<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleMakeFrmRequest;
use App\Repositories\VehicleMakeRepository;
use App\Model\CarMake;
use App\Model\CarModel;
use App\Model\CarTrim;
use Illuminate\Http\Request;
use Session;
use Response;
Use Image;
use DB;
use Illuminate\Support\Facades\Input;
use File;
use Sunra\PhpSimple\HtmlDomParser;

class VehicleMakeController extends Controller
{
    private $repository;
    public function __construct(VehicleMakeRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index()
    {
        $makes = CarMake::getAllMakes();
        return view('backend.makes.index',compact('makes'));
    }
    public function create(){
        return view('backend.makes.create');
    }
    public function edit($uuid){
        $make = CarMake::getMakeByID($uuid);
        return view('backend.makes.edit', compact('make'));
    }
    public function store(VehicleMakeFrmRequest $request){
        $data =[
            'name'=> $request->get('name'),
            'niceName'=> $request->get('niceName'),
        ];
        if(CarMake::insertMake($data)){
            if ($request->hasFile('logo'))
            {
                $file = $request->file('logo');
                $filename = strtolower(str_random(50) . '.' . $file->getClientOriginalExtension());
                $file->move('assets/car_images/logos/'.$make->uuid, $filename);
                Image::make(sprintf('assets/car_images/logos/'.$make->uuid.'/%s', $filename))->resize(100,100, function ($constraint) {
                    $constraint->aspectRatio();
                })->save();
                $make->logo = $filename;
                $make->save();
            }
            Session::flash('success','Vehicle make created successfully');
            return Response::json(array('success' => true, 'msg' => 'Vehicle make created successfully'), 200);
        }else{
            Session::flash('error','Vehicle make creation failed');
            return Response::json(array('success' => false, 'msg' => 'Vehicle make creation failed'), 422);
        }
    }
    public function update(VehicleMakeFrmRequest $request,$uuid){
        $data =[
            'name'=> $request->get('name'),
            'niceName'=> $request->get('niceName'),
        ];
        if(CarMake::updateMake($uuid, $data)){
            if ($request->hasFile('logo'))
            {
                $file = $request->file('logo');
                $filename = strtolower(str_random(50) . '.' . $file->getClientOriginalExtension());
                $file->move('assets/car_images/logos/'.$make->uuid, $filename);
                Image::make(sprintf('assets/car_images/logos/'.$make->uuid.'/%s', $filename))->resize(100,100, function ($constraint) {
                    $constraint->aspectRatio();
                })->save();
                File::delete('assets/car_images/logos/'.$make->uuid.'/'.$make->logo);
                $make->logo = $filename;
                $make->save();
            }
            Session::flash('success','Vehicle make updated successfully');
            return Response::json(array('success' => true, 'msg' => 'Vehicle make updated successfully'), 200);
        }else{
            Session::flash('error','Vehicle make update failed');
            return Response::json(array('success' => false, 'msg' => 'Vehicle make update failed'), 422);
        }
    }
    public function destroy($uuid){
        if(CarMake::deleteMake($uuid)){
            Session::flash('success','Vehicle make deleted successfully');
        }else{
            Session::flash('error','Vehicle make deletion failed');
        }
        return redirect()->route('admin.makes.index');
    }
    public function make_models(Request $request){
        $id_car_make = $request->input('make');
        $year = '2018';
        if($request->has('year')){
            $year = $request->input('year');
        }
        $models = CarModel::getModelsByMake($id_car_make,$year);
        return $models;
    }

    public function model_trims(Request $request){
        $id_car_model = $request->input('model');
        $trims = CarTrim::getTrimsByModelID($id_car_model);
        return $trims;
    }

    public function toggle_make(){
        $key = Input::get('key');
        $status = Input::get('status');
        $this->repository->update(['status'=>$status],$key);
    }

    /**
     *
     * Get Makes Information from Edmunds and update DB
     *
     */
    public function update_makes(){
        $edmunds_url = "https://www.edmunds.com/";
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $edmunds_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_SSL_VERIFYPEER => false,
        //CURLOPT_CAPATH => '/etc/ssl/certs',
        //CURLOPT_SSL_VERIFYHOST => 2,
        CURLOPT_HTTPHEADER => array(
          "Cache-Control: no-cache",
          "Postman-Token: c4df7277-e7dd-41d3-b110-c5d9f66203c6",
          "accept: */*",
          "accept-encoding: gzip, deflate, br",
          "accept-language: en-US,en;q=0.9",
          "authority: www.edmunds.com",
          "Host: www.edmunds.com",
          "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36"
        ),
        ));
        $results = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $makes = array();
        $count = 0;
        $umakes = array();
        if(!$err){
            $html = HtmlDomParser::str_get_html( $results );
            $i = 0;
            foreach($html->find('select[name=select-make]',0)->find('option') as $element){
                if($i != 0){
                    $makes[$i]['name'] = $element->plaintext;
                    $makes[$i]['niceName'] = $element->value;
                    $makes_info = CarMake::getMakeByName($makes[$i]['name'], $makes[$i]['niceName']);
                    if(!$makes_info){
                        $now = time();
                        $insert_array = array(
                            'name' => $makes[$i]['name'],
                            'niceName' => $makes[$i]['niceName'],
                            'date_create' => $now,
                            'date_update' => $now,
                        );
                        $id = CarMake::insertMake($insert_array);   
                        $umakes[] = $makes[$i]['name'];
                        $count++;
                    }
                }
                $i++;
            }
        }
        return json_encode(array('success' => true, 'msg' => $count.' Vehicle makes updated successfully', 'detail' => $umakes));
    }
}
