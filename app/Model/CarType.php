<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CarType extends Model
{

    /**
     * The DB table name
     *
     * @var string
     */
    protected $table = "car_type";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_car_type',  'name'
    ];


    /**
     *
     * Get CarType ID
     *
     * @param carType
     * @return CarTypeID
     */
    public static function getCarTypeId($car_type){
        $result = Static::where('name', $car_type)->first();
        if($result){
            return $result->id_car_type;
        }else{
            return Static::insertGetId(array('name' => $car_type));
        }
    }

    public static function getCarTypeByID($id_car_type){
        return Static::where('id_car_type', $id_car_type)->first();
    }
    /**
     *
     * Get All CarType
     *
     * @return array
     */
    public static function getAllCarType(){
        return Static::get();
    }
}