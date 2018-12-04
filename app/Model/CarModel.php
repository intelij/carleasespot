<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{

    /**
     * The DB table name
     *
     * @var string
     */
    protected $table = "car_model";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_car_model',  'id_car_make', 'name', 'niceName', 'year', 'date_create', 'date_update', 'id_car_type', 'model_image','youtube_link','search_image'
    ];

    /**
     *
     * Insert model data
     *
     * @param insertArray
     * @return insertID
     */
    public static function insertModel($insertArray){
    	return Static::insertGetId($insertArray);
    }

    /**
     *
     * Get All Model
     *
     */
    public static function getAllModels(){
        return Static::get();
    }

    /**
     * Get All Models with Make name
     *
     */
    public static function getAllModelsWithMakeName(){
        return \DB::table('car_model as a')->select(\DB::raw("a.*, b.name as make_name, b.niceName as make_niceName"))
            ->join('car_make as b', 'b.id_car_make', '=', 'a.id_car_make')->orderBy('b.name','asc')->orderBy('a.year', 'asc')->orderBy('a.name', 'asc')->get();
    }
    /**
     * Get CarModel By Makeid
     *
     * @param makeID
     * @return array
     *
     */
    public static function getModelsByMake($make_id, $year = ''){
        if($year != ''){
            return Static::where('id_car_make', $make_id)->where('year', $year)->orderBy('year','asc')->orderBy('name','asc')->get();    
        }else{
            return Static::where('id_car_make', $make_id)->orderBy('year','asc')->orderBy('name','asc')->get();
        }
        
    }
    public static function getModelwithSimpleCondition($make_id, $niceName, $year){
        return Static::where('id_car_make', $make_id)->where('niceName', $niceName)->where('year', $year)->first();
    }

    public static function getModelByID($id_car_model){
        return Static::where('id_car_model', $id_car_model)->first();
    }

    public static function updateModel($id, $data){
        return Static::where('id_car_model', $id)->update($data);
    }

    public static function deleteModel($id){
        return Static::where('id_car_model', $id)->delete($id);
    }

    public static function getModelByName($id_car_make, $year, $name, $niceName){
        return Static::where('id_car_model', $id_car_make)->where('year',$year)->where('name', $name)->where('niceName', $niceName)->first();   
    }

}