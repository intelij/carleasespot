<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use DB;
use File;
use Illuminate\Support\Str;
use App\Entities\VehicleMake;
use App\Entities\VehicleModel;
use Redirect;
use Illuminate\Support\Facades\Input;
class ExcelController extends Controller
{
    
    public function index(){
        return view('backend.upload_excel.index');
    }
    
    public function searchInitials(){

        $makemodel = VehicleMake::listing();
     
        $arr = array();
        foreach ($makemodel as $data) {
            
            $arr[] = ["car_id" =>$data->id_car_make.','.$data->id_car_model.','.$data->id_car_trim , "car_name" => $data->make.' '.$data->model.' '.$data->trim];
        }

        $data['success'] = true;
        $data['makemodel'] = $arr;
        
        return json_encode($makemodel);
    }

    public function fetchCars(){
        $car1 =Input::get('car1');
        $car2 =Input::get('car2');

        $car1 = explode(',',$car1);
        $make_car1 = $car1[0];
        $model_car1 = $car1[1];
        $trim_car1 = $car1[2];

        $car2 = explode(',',$car2);
        $make_car2 = $car2[0];
        $model_car2 = $car2[1];
        $trim_car2 = $car2[2];

        $car1_data = VehicleModel::where('id_car_make',$make_car1)->where('id_car_model',$model_car1)->first();

        $car2_data = VehicleModel::where('id_car_make',$make_car2)->where('id_car_model',$model_car2)->first();
        // $detail_car1 = VehicleMake::listing()->where('vehicle_makes.id_car_make',$make_car1)->where('vehicle_models.id_car_model',$model_car1)->addSelect('car_trim.id_car_serie')->where('car_trim.id_car_trim',$trim_car1)->distinct('id_car_trim')->first();
        
           $detail_car1 = DB::table('vehicle_makes')->where('vehicle_makes.id_car_make','=',$make_car1)->select('vehicle_makes.name as make', 'vehicle_makes.id_car_make','vehicle_models.name as model','vehicle_models.id_car_model',
                'vehicle_models.uuid as  model_id' ,
                'vehicle_makes.uuid',
                'car_model.search_image as image',
                "vehicle_models.make_id")->join('vehicle_models','vehicle_models.make_id','=','vehicle_makes.uuid')
                  ->join('car_model','vehicle_models.id_car_model','=','car_model.id_car_model')
               // ->join('car_serie','car_serie.id_car_model','=','vehicle_models.id_car_model')
              //  ->join('listings','listings.id_car_make','=','vehicle_makes.uuid')
                ->first();

        // $detail_car2 = VehicleMake::listing()->where('vehicle_makes.id_car_make',$make_car2)->where('vehicle_models.id_car_model',$model_car2)->addSelect('car_trim.id_car_serie')->where('car_trim.id_car_trim',$trim_car2)->distinct('id_car_trim')->first();
        //   $detail_car2 = VehicleMake::listing()->where('vehicle_makes.id_car_make',$make_car2)->where('vehicle_models.id_car_model',$model_car2)->where('car_trim.id_car_trim',$trim_car2)->distinct('id_car_trim')->first();
  $detail_car2 = DB::table('vehicle_makes')->where('vehicle_makes.id_car_make','=',$make_car2)->select('vehicle_makes.name as make', 'vehicle_makes.id_car_make','vehicle_models.name as model','vehicle_models.id_car_model',
                'vehicle_models.uuid as  model_id' ,
                'vehicle_makes.uuid',
                'car_model.search_image as image',
                "vehicle_models.make_id")->join('vehicle_models','vehicle_models.make_id','=','vehicle_makes.uuid')
                  ->join('car_model','vehicle_models.id_car_model','=','car_model.id_car_model')
               // ->join('car_serie','car_serie.id_car_model','=','vehicle_models.id_car_model')
              //  ->join('listings','listings.id_car_make','=','vehicle_makes.uuid')
                ->first();
        // $detail_car1->image =  DB::table('car_images')->where('make_id',$detail_car1->make_id)->get();
// dd($detail_car2);
// exit;
        // $detail_car2->image =  DB::table('car_images')->where('make_id',$car2_data->make_id)->where('model_id',$car2_data->model_id)->get();


        $opt_ids = ["12493","24823","409","614","494","11773","22200","25930","110","8270","5880","6397","32051","6290","754","12491","16497","19417","22253","194","1571","1588","1694","16226","26681","4502","4976","614","1853","2","723","1385","4271","4458","2283","524","1723","5416","9187","30768","9724","9725","9726","10095","10196","11894","12776","27","120","202","815","1012","2066","5453","11561","14166","17809","20690","170","179","1351","1829","157","1639","1738","1789","2673","1346","1478","4202","8370","11174","15349","15352","25416","25417","26681","28524"];

        $ac = ["194","500","139","157","1639","1738","1789","2673"];
        $connectivity = ["26681","1346","1478","4202","8370","11174","15349","15352","25416","25417","26681","28524"];
        $cruise_control = ["4502"];
        $entertainment = ["4976"];
        $front_parking = ["1853"];
        $power_steering = ["2"];
        $power_window = ["614"];
        $push_start = ["723","1385","4271","4458"];
        $rear_parking = ["2283"];
        $roof_rack = ["524"];
        $sunroof = ["1723"];
        $warranty = ["5416"];
        $wheel_metal = ["30768","9726"];
        $wheel_size = ["9724","9725"];
        $abs = ["10095","10196","11894"];
        $driver_airbag = ["27"];
        $electronic_brake_system = ["120","202"];
        $electronic_door_lock = ["815","1012",""];
        $fron_passenger_airbag = ["12776"];
        $immobilizer = ["4458","2066","5453","11561"];
        $security_alarm = ["11561","14166","17809","20690"];
        $stability_control = ["170","179","1351","1829"];
        $side_airbag = ["12776"];

        $options1 = DB::table('car_option')->select('car_option.name as option','car_option_value.is_base as value' , 'car_option.id_car_option')
            ->where('car_equipment.id_car_trim',$trim_car1)
            ->where('car_trim.id_car_model',$model_car1)
            ->whereIn('car_option.id_car_option',$opt_ids)
            ->join('car_option_value','car_option.id_car_option','=','car_option_value.id_car_option')
            ->join('car_equipment','car_equipment.id_car_equipment','=',"car_option_value.id_car_equipment")
            ->join('car_trim','car_trim.id_car_trim','=','car_equipment.id_car_trim')
            ->distinct('option')
            ->get();
        $options2 = DB::table('car_option')->select('car_option.name as option','car_option_value.is_base as value' , 'car_option.id_car_option')
            ->where('car_equipment.id_car_trim',$trim_car2)
            ->where('car_trim.id_car_model',$model_car2)
            ->whereIn('car_option.id_car_option',$opt_ids)
            ->join('car_option_value','car_option.id_car_option','=','car_option_value.id_car_option')
            ->join('car_equipment','car_equipment.id_car_equipment','=',"car_option_value.id_car_equipment")
            ->join('car_trim','car_trim.id_car_trim','=','car_equipment.id_car_trim')
            ->distinct('option')
            ->get();
        

        foreach ($options1 as $option) {
            if(in_array($option->id_car_option,$ac)){
                $detail_car1->ac = ($option->value == 1)?$option->option:'';                
            }else if(in_array($option->id_car_option,$connectivity)){
                $detail_car1->connectivity = ($option->value == 1)?$option->option:'';
                
            }else if(in_array($option->id_car_option,$cruise_control)){
                $detail_car1->cruise_control = $option->value;
                
            }else if(in_array($option->id_car_option,$entertainment)){
                $detail_car1->entertainment = ($option->value == 1)?$option->option:'';
                
            }else if(in_array($option->id_car_option,$front_parking)){
                $detail_car1->front_parking = $option->value;
                
            }else if(in_array($option->id_car_option,$power_steering)){
                $detail_car1->power_steering = $option->value;
                
            }else if(in_array($option->id_car_option,$power_window)){
                $detail_car1->power_window = $option->value;
                
            }else if(in_array($option->id_car_option,$push_start)){
                $detail_car1->push_start = $option->value;
                
            }else if(in_array($option->id_car_option,$rear_parking)){
                $detail_car1->rear_parking = $option->value;
                
            }else if(in_array($option->id_car_option,$roof_rack)){
                $detail_car1->roof_rack = $option->value;
                
            }else if(in_array($option->id_car_option,$sunroof)){
                $detail_car1->sunroof = $option->value;
                
            }else if(in_array($option->id_car_option,$warranty)){
                $detail_car1->warranty = ($option->value == 1)?$option->option:'';
                
            }else if(in_array($option->id_car_option,$wheel_metal)){
                $detail_car1->wheel_metal = ($option->value == 1)?$option->option:'';
                
            }else if(in_array($option->id_car_option,$wheel_size)){
                $detail_car1->wheel_size = ($option->value == 1)?$option->option:'';
                
            }else if(in_array($option->id_car_option,$abs)){
                $detail_car1->abs = $option->value;
                
            }else if(in_array($option->id_car_option,$driver_airbag)){
                $detail_car1->driver_airbag = $option->value;
                
            }else if(in_array($option->id_car_option,$electronic_brake_system)){
                $detail_car1->electronic_brake_system = $option->value;
                
            }else if(in_array($option->id_car_option,$electronic_door_lock)){
                $detail_car1->electronic_door_lock = $option->value;
                
            }else if(in_array($option->id_car_option,$fron_passenger_airbag)){
                $detail_car1->fron_passenger_airbag = $option->value;
                
            }else if(in_array($option->id_car_option,$immobilizer)){
                $detail_car1->immobilizer = $option->value;
                
            }else if(in_array($option->id_car_option,$security_alarm)){
                $detail_car1->security_alarm = $option->value;
                
            }else if(in_array($option->id_car_option,$side_airbag)){
                $detail_car1->side_airbag = $option->value;
                
            }else if(in_array($option->id_car_option,$stability_control)){
                $detail_car1->stability_control = $option->value;
                
            }

        }
        foreach ($options2 as $option) {
            if(in_array($option->id_car_option,$ac)){
                $detail_car2->ac = ($option->value == 1)?$option->option:'';                
            }else if(in_array($option->id_car_option,$connectivity)){
                $detail_car2->connectivity = ($option->value == 1)?$option->option:'';
                
            }else if(in_array($option->id_car_option,$entertainment)){
                $detail_car2->entertainment = ($option->value == 1)?$option->option:'';
                
            }else if(in_array($option->id_car_option,$front_parking)){
                $detail_car2->front_parking = $option->value;
                
            }else if(in_array($option->id_car_option,$power_steering)){
                $detail_car2->power_steering = $option->value;
                
            }else if(in_array($option->id_car_option,$power_window)){
                $detail_car2->power_window = $option->value;
                
            }else if(in_array($option->id_car_option,$push_start)){
                $detail_car2->push_start = $option->value;
                
            }else if(in_array($option->id_car_option,$rear_parking)){
                $detail_car2->rear_parking = $option->value;
                
            }else if(in_array($option->id_car_option,$roof_rack)){
                $detail_car2->roof_rack = $option->value;
                
            }else if(in_array($option->id_car_option,$sunroof)){
                $detail_car2->sunroof = $option->value;
                
            }else if(in_array($option->id_car_option,$warranty)){
                $detail_car2->warranty = ($option->value == 1)?$option->option:'';
                
            }else if(in_array($option->id_car_option,$wheel_metal)){
                $detail_car2->wheel_metal = ($option->value == 1)?$option->option:'';
                
            }else if(in_array($option->id_car_option,$wheel_size)){
                $detail_car2->wheel_size = ($option->value == 1)?$option->option:'';
                
            }else if(in_array($option->id_car_option,$abs)){
                $detail_car2->abs = $option->value;
                
            }else if(in_array($option->id_car_option,$driver_airbag)){
                $detail_car2->driver_airbag = $option->value;
                
            }else if(in_array($option->id_car_option,$electronic_brake_system)){
                $detail_car2->electronic_brake_system = $option->value;
                
            }else if(in_array($option->id_car_option,$electronic_door_lock)){
                $detail_car2->electronic_door_lock = $option->value;
                
            }else if(in_array($option->id_car_option,$fron_passenger_airbag)){
                $detail_car2->fron_passenger_airbag = $option->value;
                
            }else if(in_array($option->id_car_option,$immobilizer)){
                $detail_car2->immobilizer = $option->value;
                
            }else if(in_array($option->id_car_option,$security_alarm)){
                $detail_car2->security_alarm = $option->value;
                
            }else if(in_array($option->id_car_option,$side_airbag)){
                $detail_car2->side_airbag = $option->value;
                
            }else if(in_array($option->id_car_option,$stability_control)){
                $detail_car2->stability_control = $option->value;
                
            }

        }

        $specifications1 = DB::table('car_specification')->select('car_specification_value.value','car_specification_value.unit','car_specification.name as specifier')
            ->where('car_specification_value.id_car_trim',$trim_car1)
            ->where('car_trim.id_car_model',$model_car1)
            ->join('car_specification_value','car_specification.id_car_specification','=','car_specification_value.id_car_specification')
            ->join('car_trim','car_trim.id_car_trim','=','car_specification_value.id_car_trim')
            ->orderBy('car_specification.id_parent')
            ->get();
        $specifications2 = DB::table('car_specification')->select('car_specification_value.value','car_specification_value.unit','car_specification.name as specifier')
            ->where('car_specification_value.id_car_trim',$trim_car2)
            ->where('car_trim.id_car_model',$model_car2)
            ->join('car_specification_value','car_specification.id_car_specification','=','car_specification_value.id_car_specification')
            ->join('car_trim','car_trim.id_car_trim','=','car_specification_value.id_car_trim')
            ->orderBy('car_specification.id_parent')
            ->get();

        foreach ($specifications1 as $specification) {
            if($specification->specifier == 14){

                $detail_car1->engine_type = $specifier->value.' '.$specifier->unit;

            }elseif($specification->specifier == 13){

                $detail_car1->displacement = $specifier->value.' '.$specifier->unit;

            }elseif($specification->specifier == 4){

                $detail_car1->seater = $specifier->value.' '.$specifier->unit;

            }elseif($specification->specifier == 20){

                $detail_car1->cylinder = $specifier->value.' '.$specifier->unit;

            }elseif($specification->specifier == 39){

                $detail_car1->valves_per_cylinder = $specifier->value.' '.$specifier->unit;

            }
        }

        foreach ($specifications2 as $specification) {
            if($specification->specifier == 14){

                $detail_car2->engine_type = $specifier->value.' '.$specifier->unit;

            }elseif($specification->specifier == 13){

                $detail_car2->displacement = $specifier->value.' '.$specifier->unit;

            }elseif($specification->specifier == 4){

                $detail_car2->seater = $specifier->value.' '.$specifier->unit;

            }elseif($specification->specifier == 20){

                $detail_car2->cylinder = $specifier->value.' '.$specifier->unit;

            }elseif($specification->specifier == 39){

                $detail_car2->valves_per_cylinder = $specifier->value.' '.$specifier->unit;

            }elseif($specification->specifier == 50){

                $detail_car2->mileage_city = $specifier->value.' '.$specifier->unit;

            }elseif($specification->specifier == 51){

                $detail_car2->mileage_highway = $specifier->value.' '.$specifier->unit;

            }elseif($specification->specifier == 33){

                $detail_car2->acceleration = $specifier->value.' '.$specifier->unit;

            }elseif($specification->specifier == 15){

                $detail_car2->output = $specifier->value.' '.$specifier->unit;

            }elseif($specification->specifier == 32){

                $detail_car2->top_speed = $specifier->value.' '.$specifier->unit;

            }elseif($specification->specifier == 16){

                $detail_car2->torque = $specifier->value.' '.$specifier->unit;

            }
        }

        $data['success'] = true;
        $data['car1'] = $detail_car1;
        $data['car2'] = $detail_car2;

        // die();
        return json_encode($data);
    }

    public function upload()
    {   
        // return Input::all();
        if(Input::hasFile('excel_file')){
            $destination = 'excel_files/';
            $file = Input::file('excel_file');
            $filename = Input::file('excel_file')->getClientOriginalName();
            $extension = Input::file('excel_file')->getClientOriginalExtension();
            $table_name = str_replace('.'.$extension, '',$filename);
            $name = strtotime("now").'.'.strtolower($extension);
            $file = $file->move($destination, $name);
            if(File::exists($destination.$name)){


                ini_set('max_execution_time', -1);
                if($filename == 'car_make' || $filename == 'car_model'){
                    $row = 1;
                    $fields = [];
                    if (($handle = fopen($destination.$name, "r")) !== FALSE) {
                        set_time_limit(20000);
                        while (($data = fgetcsv($handle, 2000000, ",")) !== FALSE) {
                            if($row == 1){
                                foreach ($data as $col) {
                                     
                                    array_push($fields,trim($col,"'"));
                                }
                            }else{
                                $sn = 0;
                                foreach ($fields as $field) {
                                    $cData[$field] = trim($data[$sn],"'");
                                    $sn++;
                                }
                                
                                if($table_name == 'car_make'){
                                    $check_make = VehicleMake::where('id_car_make' , $cData['id_car_make'])->first();
                                    if(!$check_make){

                                        $newMake = new VehicleMake;
                                        $newMake->id_car_make = $cData["id_car_make"];
                                        $newMake->name = $cData["name"];
                                        $newMake->status =1;
                                        $newMake->save();
                                    }
                                }else if($table_name == 'car_model'){
                                    $make_id = DB::table('vehicle_makes')->where('id_car_make',$cData['id_car_make'])->first();

                                    $check_model = VehicleModel::where('id_car_make' , $cData['id_car_make'])->where('id_car_model' , $cData['id_car_model'])->first();
                                    if(!$check_model){

                                        $newModel = new VehicleModel;
                                        $newModel->id_car_make = $cData["id_car_make"];
                                        $newModel->id_car_model = $cData['id_car_model'];
                                        $newModel->name = $cData["name"];
                                        $newModel->status = 1;
                                        $newModel->make_id = $make_id->uuid;
                                        $newModel->save();
                                    }
                                        
                                    
                                }
                            }

                            
                            $row++;
                        }
                        fclose($handle);
                    }

                    $result = Excel::filter('chunk')->load($destination.$name)->chunk(1000, function($results) use ($table_name)
                    {
                        foreach($results as $data)
                        {
                            
                            foreach ($data as $key => $value) {
                                $cData[$key] = trim($value,"'");

                            } 
                            unset($cData[0]);
                            if($table_name == 'car_make'){
                                // foreach ($car_data as $cData) {
                                    $check_make = VehicleMake::where('id_car_make' , $cData['id_car_make'])->first();
                                    if(!$check_make){

                                        $newMake = new VehicleMake;
                                        $newMake->id_car_make = $cData["id_car_make"];
                                        $newMake->name = $cData["name"];
                                        $newMake->status =1;
                                        $newMake->save();
                                    }
                                // }
                            }else if($table_name == 'car_model'){
                                // foreach ($car_data as $cData) {
                                    $make_id = DB::table('vehicle_makes')->where('id_car_make',$cData['id_car_make'])->first();

                                    $check_model = VehicleModel::where('id_car_make' , $cData['id_car_make'])->where('id_car_model' , $cData['id_car_model'])->first();
                                    if(!$check_model){

                                        $newModel = new VehicleModel;
                                        $newModel->id_car_make = $cData["id_car_make"];
                                        $newModel->id_car_model = $cData['id_car_model'];
                                        $newModel->name = $cData["name"];
                                        $newModel->status = 1;
                                        $newModel->make_id = $make_id->uuid;
                                        $newModel->save();
                                    }
                                    
                                // }
                                
                            }
                            
                            
                        }
                    });
                }else{
                                    
                    DB::table($table_name)->truncate();
                    $row = 1;
                    $fields = [];
                    if (($handle = fopen($destination.$name, "r")) !== FALSE) {
                        set_time_limit(20000);
                        while (($data = fgetcsv($handle, 2000000, ",")) !== FALSE) {
                            if($row == 1){
                                foreach ($data as $col) {
                                     
                                    array_push($fields,trim($col,"'"));
                                }
                            }else{
                                $sn = 0;
                                foreach ($fields as $field) {
                                    $cData[$field] = trim($data[$sn],"'");
                                    $sn++;
                                }
                                // $entry = DB::table($table_name)->where($fields[0],trim($data[0],"'"))->first();
                                // if(!$entry){

                                // }
                                DB::table($table_name)->insert($cData);
                            }

                            
                            $row++;
                        }
                        fclose($handle);
                    }
                }
                
                // return $final_data;

                return Redirect::back()->with('success','Data is uploaded successfully');
            }else{
                return Redirect::back()->with('failure','Please Upload Valid Excel or CSV File');
            }

        }else{
            return Redirect::back()->with('failure','Please Upload Excel File');
        }
    }
  
}
