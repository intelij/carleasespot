<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleModelFrmRequest;
use App\Repositories\VehicleMakeRepository;
use App\Repositories\VehicleModelRepository;
use App\Model\CarMake;
use App\Model\CarModel;
use Session;
use Response;
use Illuminate\Http\Request;
use App\Entities\VehicleModel;
use DB;
use Illuminate\Support\Facades\Input;
Use Image;
use File;

use Sunra\PhpSimple\HtmlDomParser;

class VehicleModelController extends Controller
{
    private $repository,$make_repository;
    public function __construct(VehicleModelRepository $repository, VehicleMakeRepository $make_repository)
    {
        $this->repository = $repository;$this->make_repository = $make_repository;

    }
    public function index()
    {
        // $models = $this->repository->orderBy('vehicle_models.name')->toSql();
        $models = CarModel::getAllModelsWithMakeName();
        // return $models;
        return view('backend.models.index',compact('models'));
    }
    public function create(){
        $makes_arr = CarMake::getAllMakes();
        $makes = array();
        $makes[''] = 'Select Option';
        foreach($makes_arr as $make){
            $makes[$make->id_car_make] = $make->name;
        }
        return view('backend.models.create',compact('makes'));
    }
    public function edit($uuid){
        $model = CarModel::getModelByID($uuid);
        $makes_arr = CarMake::getAllMakes();
        $makes = array();
        $makes[''] = 'Select Option';
        foreach($makes_arr as $make){
            $makes[$make->id_car_make] = $make->name;
        }
        return view('backend.models.edit', compact('model','makes'));
    }
    public function store(VehicleModelFrmRequest $request){
        // print_r($request->all());
        // exit;
        $filename='';
         if($request->hasFile('searchImage')){
            $file = $request->file('searchImage');
            $extension = $request->searchImage->extension();
        $filename = $request->input('searchImage').'_'.time().'.'.$extension;
            $file->move('assets/car_images/model_images', $filename);
        }
        
        $data =[
            'name'=> $request->get('name'),
            'niceName'=> $request->get('niceName'),
            'year'=> $request->get('year'),
            'id_car_make'=> $request->get('id_car_make'),
            'model_image' => $request->get('image_names'),
        ];
        
        $id = CarModel::insertModel($data);
        if($id){
            $dt = ['search_image'=> $filename];
             $car = CarModel::where('id_car_model',$id)->update($dt);
            //  $car->search_image = $filename;
            // $car->save();
           
            Session::flash('success','Vehicle model created successfully');
            return Response::json(array('success' => true, 'msg' => 'Vehicle model created successfully'), 200);
        }else{
            Session::flash('error','Vehicle model creation failed');
            return Response::json(array('success' => false, 'msg' => 'Vehicle model creation failed'), 422);
        }
    }
    public function update(VehicleModelFrmRequest $request,$uuid){
         $filename='';
         if($request->hasFile('searchImage')){
            $file = $request->file('searchImage');
            $extension = $request->searchImage->extension();
        $filename = $request->input('searchImage').'_'.time().'.'.$extension;
            $file->move('assets/car_images/model_images', $filename);
        }
        $data =[
            'name'=> $request->get('name'),
            'niceName'=> $request->get('niceName'),
            'year'=> $request->get('year'),
            'id_car_make'=> $request->get('id_car_make'),
            'model_image' => $request->get('image_names'),
            'youtube_link' => $request->get('youtube_link')
        ];
        if(CarModel::updateModel($uuid, $data)){
            $dt = ['search_image'=> $filename];
            if($filename !=''){
                $car = CarModel::where('id_car_model',$uuid)->update($dt);
            }
             
            return Response::json(array('success' => true, 'msg' => 'Vehicle model updated successfully'), 200);
        }else{
            Session::flash('error','Vehicle model update failed');
            return Response::json(array('success' => false, 'msg' => 'Vehicle model update failed'), 422);
        }
    }
    public function destroy($uuid){
        if(CarModel::deleteModel($uuid)){
            Session::flash('success','Vehicle model deleted successfully');
        }else{
            Session::flash('error','Vehicle model deletion failed');
        }
        return redirect()->route('admin.models.index');
    }

    public function toggle_model(){
        $key = Input::get('key');
        $status = Input::get('status');
        $this->repository->update(['status'=>$status],$key);
    }

    /**
     *
     * Get Models Information By Year from Edmunds and update DB
     *
     */
    public function update_models(){
        $makes = CarMake::getAllMakes();
        $count = 0;
        $umodels = array();
        foreach($makes as $make){
            $edmunds_url = "https://www.edmunds.com/gateway/api/vehicle/v4/makes/".$make->niceName."/submodels/";
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
            if(!$err){
                $results = json_decode($results, true);
                if(isset($results['results'])){
                    foreach($results['results'] as $niceName => $result){
                        if(isset($result['pubStates']['NEW']) || isset($result['pubStates']['NEW_USED'])){
                            $model_2018 = CarModel::getModelwithSimpleCondition($make->id_car_make, $niceName, '2018');
                            if(!$model_2018){
                                $edmunds_url = "https://www.edmunds.com/".$make->niceName."/".$niceName."/2018/";
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

                                $car_detail_result = curl_exec($curl);
                                $err = curl_error($curl);

                                if(!$err){
                                    $html = HtmlDomParser::str_get_html( $car_detail_result );
                                    if($html){
                                        if(!$html->find('div[data-tracking-parent=edm-entry-error-container]')){
                                            $model_info = CarModel::getModelByName($make->id_car_make, '2018', $result['name'], $niceName);
                                            $insert_array = array(
                                                'id_car_make' => $make->id_car_make,
                                                'name' => $result['name'],
                                                'niceName' => $niceName,
                                                'year' => '2018',
                                                'date_create' => time(),
                                                'date_update' => time()
                                            );
                                            $id = CarModel::insertModel($insert_array);
                                            $umodels[] = '2018 '.$make->name.' '.$result['name'];
                                            $count++;
                                        }    
                                    }
                                }
                            }
                            

                            $model_2019 = CarModel::getModelwithSimpleCondition($make->id_car_make, $niceName, '2019');
                            if(!$model_2019){
                                $edmunds_url = "https://www.edmunds.com/".$make->niceName."/".$niceName."/2019/";
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

                                $car_detail_result = curl_exec($curl);
                                $err = curl_error($curl);

                                if(!$err){
                                    $html = HtmlDomParser::str_get_html( $car_detail_result );
                                    if($html){
                                        if(!$html->find('div[data-tracking-parent=edm-entry-error-container]')){
                                            $model_info = CarModel::getModelByName($make->id_car_make, '2019', $result['name'], $niceName);
                                            $insert_array = array(
                                                'id_car_make' => $make->id_car_make,
                                                'name' => $result['name'],
                                                'niceName' => $niceName,
                                                'year' => '2019',
                                                'date_create' => time(),
                                                'date_update' => time()
                                            );
                                            $id = CarModel::insertModel($insert_array);
                                            $umodels[] = '2019 '.$make->name.' '.$result['name'];
                                            $count++;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return json_encode(array('success' => true, 'msg' => $count.' Vehicle models updated successfully', 'detail' => $umodels));
    }

    public function store_image(Request $request){
        if($request->hasFile('qqfile')){
            $file = $request->file('qqfile');
            $extension = $request->qqfile->extension();
            $filename = $request->input('qquuid').'_'.time().'.'.$extension;
            $file->move('assets/car_images/model_images', $filename);
            return json_encode(array('success' => true, 'filename' => $filename));
        }
    }
}
