<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CarMake extends Model
{

    /**
     * The DB table name
     *
     * @var string
     */
    protected $table = "car_make";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_car_make',  'name', 'niceName', 'date_create', 'date_update', 'id_car_type'
    ];

    /**
     *
     * Insert make data
     *
     * @param insertArray
     * @return insertID
     */
    public static function insertMake($insertArray){
    	return Static::insertGetId($insertArray);
    }

    /**
     *
     * Get All Makes
     *
     */
    public static function getAllMakes(){
        return Static::orderBy('name','asc')->get();
    }

    /**
     *
     * Get Make info
     *
     * @param id_car_make
     * @return object
     */
    public static function getMakeByID($make_id){
        return Static::where('id_car_make', $make_id)->first();
    }

    public static function updateMake($make_id, $data){
        return Static::where('id_car_make', $make_id)->update($data);
    }

    public static function deleteMake($make_id){
        return Static::where('id_car_make', $make_id)->delete();
    }

    public static function getMakeByName($name, $niceName){
        return Static::where('name', $name)->where('niceName', $niceName)->first();
    }


}