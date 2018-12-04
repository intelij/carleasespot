<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CarTrim extends Model
{

    /**
     * The DB table name
     *
     * @var string
     */
    protected $table = "car_trim";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_car_trim',  'id_car_make', 'id_car_model', 'name', 'style_id', 'style_name', 'year', 'id_car_type', 'passenger_capacity', 'tire_wheel', 'fuel_type', 'basic_warranty', 'drivetrain_warranty', 'free_maintenance', 'engine_type', 'engine_size', 'horsepower', 'drivetrain', 'transmission', 'base_price', 'base_invoice', 'mileage', 'exterior_color', 'interior_color', 'exterior_options', 'interior_options', 'trim_image', 'roadside_warranty', 'engine_cam_type', 'cylinders', 'engine_torque', 'engine_turning_circle', 'engine_valve_timing', 'engine_valves', 'engine_direct_injection', 'frontseats', 'fuel_options', 'in_car_entertainment', 'instrumentation', 'measurements', 'power_feature', 'rearseats', 'safety', 'suspension', 'telematics','date_create', 'date_update'
    ];

    /**
     *
     * Insert trim data
     *
     * @param insertArray
     * @return insertID
     */
    public static function insertTrim($insertArray){
    	return Static::insertGetId($insertArray);
    }

    /**
     *
     * Update trim&features data
     *
     * @param updateArray
     * @return updatedID
     */
    public static function updateTrim($id, $updateArray){
        return Static::where('id_car_trim', $id)->update($updateArray);
    }
    /**
     *
     * Get All trims
     *
     */
    public static function getAllTrims(){
        return Static::get();
    }

    /**
     * Get All trims with Full information
     *
     */
    public static function getAllTrimsFullinfo($make_id = '', $model_id = '', $trim_id = '', $car_type = '', $search_key = ''){
        $query =  \DB::table('car_trim as a')->select(\DB::raw("a.*, b.name as make_name, b.niceName as make_niceName, c.name as model_name, c.model_image as images, c.niceName as model_niceName, c.youtube_link as youtube_link , d.name as car_type, e.name as car_engine, g.name as car_engine_size, h.name as transmission_name, i.name as drivetrain_name"))
            ->join('car_make as b', 'b.id_car_make','=','a.id_car_make')
            ->join('car_model as c', 'c.id_car_model','=','a.id_car_model')
            ->join('car_type as d', 'd.id_car_type','=','a.id_car_type')
            ->leftJoin('car_engine_type as e', 'e.id_engine_type','=','a.engine_type')
            ->leftJoin('car_engine_size as g', 'g.id_engine_size','=','a.engine_size')
            ->leftJoin('car_transmission as h', 'h.id_car_transmission','=','a.transmission')
            ->leftJoin('car_drivetrain as i', 'i.id_car_drivetrain','=','a.drivetrain');
        if($make_id != ''){
            $query = $query->where('a.id_car_make', $make_id); 
        }
        if($model_id != ''){
            $query = $query->where('a.id_car_model', $model_id); 
        }
        if($trim_id != ''){
            $query = $query->where('a.id_car_trim', $trim_id); 
        }
        if($car_type != ''){
            $query = $query->where('a.id_car_type', $car_type);
        }
        if($search_key != ''){
            $query = $query->where(function($q) use($search_key){
                $q->where('b.name', 'like', '%'.$search_key.'%')
                 ->orWhere('c.name', 'like', '%'.$search_key.'%')
                 ->orWhere('a.name', 'like', '%'.$search_key.'%')
                 ->orWhere('d.name', 'like', '%'.$search_key.'%');
            });
        }
        return $query->orderBy('b.name', 'asc')->orderBy('a.year','asc')->orderBy('c.name', 'asc')->get();
    }

    public static function getAllModelwithTrimByType($car_type){
        $query =  \DB::table('car_trim as a')->select(\DB::raw("a.*, b.name as make_name, b.niceName as make_niceName, c.name as model_name, c.niceName as model_niceName, c.model_image as model_image , d.name as car_type, e.name as car_engine"))
            ->join('car_make as b', 'b.id_car_make','=','a.id_car_make')
            ->join('car_model as c', 'c.id_car_model','=','a.id_car_model')
            ->join('car_type as d', 'd.id_car_type','=','a.id_car_type')
            ->join('car_engine_type as e', 'e.id_engine_type','=','a.engine_type');
        if($car_type != ''){
            $query = $query->where('a.id_car_type', $car_type);
        }
        return $query->groupBy('a.id_car_model')->get();
    }

    /**
     *
     * Get Trim information from Style_ID
     *
     * @param styleID
     * @return Object
     */
    public static function getTrimByStyleID($styleID){
        return Static::where('style_id', $styleID)->first();
    }

    /**
     *
     * Get Trim information from Trim_id
     *
     * @param trimID
     * @return Object
     */
    public static function getTrimByID($trim_id){
        return Static::where('id_car_trim', $trim_id)->first();
    }

    /**
     *
     * Get Trim information from ModelID
     *
     * @param ModelID, year
     * @return array
     */
    public static function getTrimsByModelID($model_id, $year = ''){

        $result =  Static::where('id_car_model', $model_id);
        if($year != ''){
            return $result->where('year', $year)->get();
        }
        return $result->get();
    }

    public static function deleteTrim($id){
        return Static::where('id_car_trim', $id)->delete();
    }

}