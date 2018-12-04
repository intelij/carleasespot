<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CarEngineType extends Model
{

    /**
     * The DB table name
     *
     * @var string
     */
    protected $table = "car_engine_type";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_engine_type',  'name'
    ];


    /**
     *
     * Get CarEngineType ID
     *
     * @param EngineType
     * @return EngineTypeID
     */
    public static function getCarEngineTypeId($engine_type){
        $result = Static::where('name', $engine_type)->first();
        if($result){
            return $result->id_engine_type;
        }else{
            return Static::insertGetId(array('name' => $engine_type));
        }
    }
}