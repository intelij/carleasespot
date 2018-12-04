<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CarTransmission extends Model
{

    /**
     * The DB table name
     *
     * @var string
     */
    protected $table = "car_transmission";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_car_transmission',  'name'
    ];


    /**
     *
     * Get Transmission ID
     *
     * @param Transmission Name
     * @return Transmission ID
     */
    public static function getCarTransmissionId($transmission){
        $result = Static::where('name', $transmission)->first();
        if($result){
            return $result->id_car_transmission;
        }else{
            return Static::insertGetId(array('name' => $transmission));
        }
    }
}