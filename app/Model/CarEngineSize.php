<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CarEngineSize extends Model
{

    /**
     * The DB table name
     *
     * @var string
     */
    protected $table = "car_engine_size";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_engine_size',  'name'
    ];


    /**
     *
     * Get CarEngineSize ID
     *
     * @param EngineSize
     * @return EngineSizeID
     */
    public static function getCarEngineSizeId($engine_size){
        $result = Static::where('name', $engine_size)->first();
        if($result){
            return $result->id_engine_size;
        }else{
            return Static::insertGetId(array('name' => $engine_size));
        }
    }
}