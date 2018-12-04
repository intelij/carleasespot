<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CarDrivetrain extends Model
{

    /**
     * The DB table name
     *
     * @var string
     */
    protected $table = "car_drivetrain";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_car_drivetrain',  'name'
    ];


    /**
     *
     * Get CarDrivetrain ID
     *
     * @param Drivetrain
     * @return DrivetrainID
     */
    public static function getCarDrivetrainId($drivetrain){
        $result = Static::where('name', $drivetrain)->first();
        if($result){
            return $result->id_car_drivetrain;
        }else{
            return Static::insertGetId(array('name' => $drivetrain));
        }
    }
}