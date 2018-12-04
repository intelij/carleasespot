<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleTrimFrmRequest;
use App\Repositories\VehicleMakeRepository;
use App\Repositories\VehicleModelRepository;
use App\Model\CarMake;
use App\Model\CarModel;
use App\Model\CarTrim;
use App\Model\CarType;
use App\Model\CarEngineType;
use App\Model\CarEngineSize;
use App\Model\CarTransmission;
use App\Model\CarColor;
use App\Model\CarDrivetrain;
use Session;
use Response;
use Request;
use App\Entities\VehicleModel;
use DB;
use Illuminate\Support\Facades\Input;
Use Image;
use File;


use Sunra\PhpSimple\HtmlDomParser;

class VehicleTrimController extends Controller
{
	public function index(){
		$trims = CarTrim::getAllTrimsFullinfo();
		return view('backend.trims.index',compact('trims'));
	}
	public function detail($id_car_trim){
		$trim = CarTrim::getAllTrimsFullinfo('', '', $id_car_trim);
		$trim = $trim[0];
		$ex_colors = $trim->exterior_color;
		$ext_colors = array();
		if($ex_colors){
			$ex_colors_arr = explode(',', $ex_colors);
			foreach($ex_colors_arr as $id){
				$color_info = CarColor::getColorInfoByID($id);
				$ext_colors[] = $color_info;
			}
		}else{
			$ext_colors = 'N/A';
		}
		$trim->ext_colors = $ext_colors;
		$in_colors = $trim->interior_color;
		$int_colors = array();
		if($in_colors){
			$in_colors_arr = explode(',', $in_colors);
			foreach($in_colors_arr as $id){
				$color_info = CarColor::getColorInfoByID($id);
				$int_colors[] = $color_info;
			}
		}else{
			$int_colors = 'N/A';
		}
		$trim->int_colors = $int_colors;
		return view('backend.trims.detail',compact('trim'));
	}
	public function upload_image($id_car_trim){
		$trim = CarTrim::getAllTrimsFullinfo('', '', $id_car_trim);
		$trim = $trim[0];
		return view('backend.trims.upload',compact('trim'));
	}
	public function store_image($id, VehicleTrimFrmRequest $request){
		if ($request->hasFile('trim_image'))
        {
            $file = $request->file('trim_image');
            $filename = 'trim_'.$id.'.'.$request->trim_image->extension();
            $file->move('assets/car_images/trim', $filename);
            CarTrim::updateTrim($id, array('trim_image'=>$filename));
        }
        Session::flash('success','Vehicle model created successfully');
        return Response::json(array('success' => true, 'msg' => 'Vehicle model created successfully'), 200);
	}
	public function destroy($id){
		if(CarTrim::deleteTrim($id)){
            Session::flash('success','Vehicle trim deleted successfully');
        }else{
            Session::flash('error','Vehicle trim deletion failed');
        }
        return redirect()->route('admin.trims.index');
	}
	public function update_trim_name(){
		$trims = CarTrim::getAllTrims();
		foreach($trims as $trim){
			if($trim->name == ''){
				if($trim->style_name != '' || $trim->style_name != null){
					$trim_name = '';
					$style_name = $trim->style_name;
			      	if(strpos($style_name, '4dr') !== false){
						if(strpos($style_name, '4dr') == 0){
							$trim_name = 'Base';
						}else{
							$trim_name = trim(substr($style_name, 0, strpos($style_name, '4dr')));
						}
		    		}elseif(strpos($style_name, '2dr') !== false){
			      		if(strpos($style_name, '2dr') == 0){
				        	$trim_name = 'Base';
			      		}else{
				        	$trim_name = trim(substr($style_name, 0, strpos($style_name, '2dr')));
				      	}
				    }elseif(strpos($style_name, '3dr') !== false){
			      		if(strpos($style_name, '3dr') == 0){
				        	$trim_name = 'Base';
			      		}else{
				        	$trim_name = trim(substr($style_name, 0, strpos($style_name, '3dr')));
				      	}
				    }
				    CarTrim::updateTrim($trim->id_car_trim, array('name' => $trim_name));
				}
			}
		}
	}
	public function update_trims(){
		$makes_info = CarMake::getAllMakes();
		$insert_count = 0;
		$update_count = 0;
		$insert_trims = array();
		$update_trims = array();
		$makes = array();
		foreach($makes_info as $make){
			$makes[$make->id_car_make] = $make;
		}
		$models = CarModel::getAllModels();
		foreach($models as $model){
			$edmunds_url = "https://www.edmunds.com/".$makes[$model->id_car_make]->niceName."/".$model->niceName."/".$model->year."/features-specs/";
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
                $html = HtmlDomParser::str_get_html( $results );
                if($html){
                	if($html->find('select[name=core_page_view_content_features]',0)){
	                	foreach($html->find('select[name=core_page_view_content_features]',0)->find('option') as $value){
					      	$style_name = $value->plaintext;
					      	$style_id = $value->value;
					      	$trim_info = CarTrim::getTrimByStyleID($style_id);
					      	if(!$trim_info){
					      		$trim = '';
						      	$car_type = '';
						      	if(strpos($style_name, '4dr') !== false){
									if(strpos($style_name, '4dr') == 0){
										$trim = 'Base';
									}else{
										$trim = trim(substr($style_name, 0, strpos($style_name, '4dr')));
									}
					    		}elseif(strpos($style_name, '2dr') !== false){
						      		if(strpos($style_name, '2dr') == 0){
							        	$trim = 'Base';
						      		}else{
							        	$trim = trim(substr($style_name, 0, strpos($style_name, '2dr')));
							      	}
							    }elseif(strpos($style_name, '3dr') !== false){
						      		if(strpos($style_name, '3dr') == 0){
							        	$trim = 'Base';
						      		}else{
							        	$trim = trim(substr($style_name, 0, strpos($style_name, '3dr')));
							      	}
							    }
							    $style_name_arr = explode(' ', $style_name);
							    
							    if(strpos($style_name, 'Cab') !== FALSE || strpos($style_name, 'CrewMax') !== FALSE){
							    	$car_type = "Truck";
							    }elseif(strpos($style_name, 'Van') !== FALSE || strpos($style_name, 'Minivan') !== FALSE){
							    	$car_type = "Van/Minivan";
							    }else{
							    	$i = 0;
							    	foreach($style_name_arr as $element){
								    	if($element == '4dr'){
								    		$car_type = $style_name_arr[$i+1];
								    		break;
								    	}
								    	if($element == '2dr'){
								    		$car_type = $style_name_arr[$i+1];
								    		break;
								    	}
								    	if($element == '3dr'){
								    		$car_type = $style_name_arr[$i+1];
								    		break;
								    	}
								    	$i++;
								    }	
							    }
							    $id_car_type = CarType::getCarTypeId($car_type);
							    $insertTrim_array = array(
							    	'id_car_make' => $makes[$model->id_car_make]->id_car_make,
							    	'id_car_model' => $model->id_car_model,
							    	'name' => $trim,
							    	'style_id' => $style_id,
							    	'style_name' => $style_name,
							    	'year' => $model->year,
							    	'id_car_type' => $id_car_type,
							    	'date_create' => time(),
							    	'date_update' => time()
							    );
							    $id_car_trim = CarTrim::insertTrim($insertTrim_array);
							    $insert_count++;
							    $insert_trims[] = $model->year.' '.$makes[$model->id_car_make]->name.' '.$model->name.' '.$style_name;
							    $features = $this->getCarStyleInfo($id_car_trim, $style_id);
							    if($features){
							    	$update_count++;
							    	$update_trims[] = $model->year.' '.$makes[$model->id_car_make]->name.' '.$model->name.' '.$style_name;
							    }
					      	}else{
					      		if(!$trim_info->passenger_capacity || !$trim_info->engine_type || !$trim_info->engine_size){
					      			$features = $this->getCarStyleInfo($trim_info->id_car_trim, $trim_info->style_id);
					      			if($features){
					      				$update_count++;
					      				$update_trims[] = $trim_info->year.' '.$makes[$model->id_car_make]->name.' '.$model->name.' '.$trim_info->style_name;
					      			}
					      		}
					      	}
					    }
					}
                }
            }
		}
		return json_encode(array('success' => true, 'msg' => $insert_count.' Vehicle trims inserted successfully', 'msg1' => $update_count. ' Vehicle trims updated successfully', 'insert_detail' => $insert_trims, 'update_detail' => $update_trims));
	}

	public function getCarStyleInfo($id_car_trim, $style_id){
		$features_url = "https://www.edmunds.com/gateway/api/vehicle/v4/styles/$style_id/features-specs";
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $features_url,
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
		$fresults = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);

		//$content = array();
		if(!$err){
			if($fresults){
				$fresults = json_decode($fresults, true);
				if(isset($fresults['results'])){


					$result = $fresults['results'];

					$update_array = array();
					if(isset($result['features']['Comfort & Convenience'])){
						$comfort_convenience_options = array_keys($result['features']['Comfort & Convenience']);
						$update_array['comfort_convenience_options'] = implode(",", $comfort_convenience_options);
					}
					if(isset($result['totalSeating'])){
						$update_array['passenger_capacity'] = $result['totalSeating'];
					}
					
					if(isset($result['features']['Fuel']['Fuel type'])){
						$update_array['fuel_type'] = $result['features']['Fuel']['Fuel type'];	
					}
					if(isset($result['features']['Engine'])){
						if(isset($result['features']['Engine']['Base engine type'])){
							$engine_type = $result['features']['Engine']['Base engine type'];
							$update_array['engine_type'] = CarEngineType::getCarEngineTypeId($engine_type);	
						}
						if(isset($result['features']['Engine']['Base engine size'])){
							$engine_size = $result['features']['Engine']['Base engine size'];
							$update_array['engine_size'] = CarEngineSize::getCarEngineSizeId($engine_size);	
						}
						if(isset($result['features']['Engine']['Horsepower'])){
							$update_array['horsepower'] = $result['features']['Engine']['Horsepower'];	
						}
						//new
						if(isset($result['features']['Engine']['Cam type'])){
							$update_array['engine_cam_type'] = $result['features']['Engine']['Cam type'];	
						}
						if(isset($result['features']['Engine']['Cylinders'])){
							$update_array['cylinders'] = $result['features']['Engine']['Cylinders'];	
						}
						if(isset($result['features']['Engine']['Torque'])){
							$update_array['engine_torque'] = $result['features']['Engine']['Torque'];	
						}
						if(isset($result['features']['Engine']['Turning circle'])){
							$update_array['engine_turning_circle'] = $result['features']['Engine']['Turning circle'];	
						}
						if(isset($result['features']['Engine']['Valve timing'])){
							$update_array['engine_valve_timing'] = $result['features']['Engine']['Valve timing'];	
						}
						if(isset($result['features']['Engine']['Valves'])){
							$update_array['engine_valves'] = $result['features']['Engine']['Valves'];	
						}
						if(isset($result['features']['Engine']['direct injection'])){
							$update_array['engine_direct_injection'] = $result['features']['Engine']['direct injection'];	
						}
					}

					//new
					if(isset($result['features']['Frontseats'])){
						$update_array['frontseats'] = json_encode($result['features']['Frontseats']);
					}


					if(isset($result['features']['Drive Train'])){
						if(isset($result['features']['Drive Train']['Transmission'])){
							if(strpos($result['features']['Drive Train']['Transmission'], " ") !== FALSE){
								$transmission = substr($result['features']['Drive Train']['Transmission'], strpos($result['features']['Drive Train']['Transmission'], " ")+1);
								$update_array['transmission'] = CarTransmission::getCarTransmissionId($transmission);		
							}
							
						}
						if(isset($result['features']['Drive Train']['Drive type'])){
							$update_array['drivetrain'] = CarDrivetrain::getCarDrivetrainId($result['features']['Drive Train']['Drive type']);
						}	
					}
					
					if(isset($result['price'])){
						$update_array['base_price'] = $result['price']['baseMSRP'];
						if(isset($result['price']['baseInvoice'])){
							$update_array['base_invoice'] = $result['price']['baseInvoice'];	
						}
					}

					if(isset($result['features']['Fuel'])){
						if(isset($result['features']['Fuel']['Combined MPG'])){
							$update_array['mileage'] = $result['features']['Fuel']['Combined MPG'];	
						}

						//new
						$update_array['fuel_options'] = json_encode($result['features']['Fuel']);
					}
					
					//new
					if(isset($result['features']['In Car Entertainment'])){
						$in_car_entertainment = array_keys($result['features']['In Car Entertainment']);
						$update_array['in_car_entertainment'] = implode(",", $in_car_entertainment);
					}
					if(isset($result['features']['Instrumentation'])){
						$instrumentation = array_keys($result['features']['Instrumentation']);
						$update_array['instrumentation'] = implode(",", $instrumentation);
					}
					if(isset($result['features']['Measurements'])){
						$update_array['measurements'] = json_encode($result['features']['Measurements']);
					}
					if(isset($result['features']['Power Feature'])){
						$power_feature = array_keys($result['features']['Power Feature']);
						$update_array['power_feature'] = implode(",", $power_feature);
					}
					if(isset($result['features']['Rearseats'])){
						$update_array['rearseats'] = json_encode($result['features']['Rearseats']);
					}
					if(isset($result['features']['Safety'])){
						$safety = array_keys($result['features']['Safety']);
						$update_array['safety'] = implode(",", $safety);
					}
					if(isset($result['features']['Suspension'])){
						$suspension = array_keys($result['features']['Suspension']);
						$update_array['suspension'] = implode(",", $suspension);
					}
					if(isset($result['features']['Telematics'])){
						$telematics = array_keys($result['features']['Telematics']);
						$update_array['telematics'] = implode(",", $telematics);
					}

					if(isset($result['features']['Warranty'])){
						$update_array['basic_warranty'] = isset($result['features']['Warranty']['Basic']) ? $result['features']['Warranty']['Basic']: '';
						$update_array['drivetrain_warranty'] = isset($result['features']['Warranty']['Drivetrain']) ? $result['features']['Warranty']['Drivetrain']: '';
						$update_array['free_maintenance'] = isset($result['features']['Warranty']['Free Maintenance']) ? $result['features']['Warranty']['Free Maintenance']: '';
						//new
						$update_array['roadside_warranty'] = isset($result['features']['Warranty']['Roadside']) ? $result['features']['Warranty']['Roadside']: '';	
					}

					if(isset($result['features']['Tires and Wheels'])){
						$tire_wheels = array_keys($result['features']['Tires and Wheels']);
						$update_array['tire_wheel'] = implode(",", $tire_wheels);	
					}


					if(isset($result['color'])){
						$exterior_color_ids = array();
						if(isset($result['color']['EXTERIOR'])){
							foreach($result['color']['EXTERIOR'] as $color){
								$hex = '';
								if(isset($color['rgb'])){
									$rgb_array = explode(",", $color['rgb']);
									$hex = $this->fromRGB($rgb_array[0], $rgb_array[1], $rgb_array[2]);	
								}
								$exterior_color_ids[] = CarColor::getCarColorId($color['name'], $hex);
							}
							$update_array['exterior_color'] = implode(",", $exterior_color_ids);	
						}
						$interior_color_ids = array();
						if(isset($result['color']['INTERIOR'])){
							foreach($result['color']['INTERIOR'] as $color){
								$hex = '';
								if(isset($color['rgb'])){
									$rgb_array = explode(",", $color['rgb']);
									$hex = $this->fromRGB($rgb_array[0], $rgb_array[1], $rgb_array[2]);	
								}
								$interior_color_ids[] = CarColor::getCarColorId($color['name'], $hex);
							}
							$update_array['interior_color'] = implode(",", $interior_color_ids);	
						}
					}
					
					if(isset($result['features']['Exterior Options'])){
						$exterior_options = array_keys($result['features']['Exterior Options']);
						$update_array['exterior_options'] = implode(",", $exterior_options);	
					}
					
					if(isset($result['features']['Interior Options'])){
						$interior_options = array_keys($result['features']['Interior Options']);
						$update_array['interior_options'] = implode(",", $interior_options);	
					}

					

					$update_array['date_update'] = time();
					$update_id = CarTrim::updateTrim($id_car_trim, $update_array);

					return $fresults['results'];
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
	}

	

	public function fromRGB($R, $G, $B)
  	{

		$R = dechex($R);
		if (strlen($R)<2)
		$R = '0'.$R;

		$G = dechex($G);
		if (strlen($G)<2)
		$G = '0'.$G;

		$B = dechex($B);
		if (strlen($B)<2)
		$B = '0'.$B;

		return $R . $G . $B;
  	}
}