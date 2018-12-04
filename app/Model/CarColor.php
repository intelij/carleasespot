<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CarColor extends Model
{

    /**
     * The DB table name
     *
     * @var string
     */
    protected $table = "car_color";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_car_color',  'name', 'hex'
    ];


    /**
     *
     * Get CarColor ID
     *
     * @param Color name, Color hex
     * @return Color ID
     */
    public static function getCarColorId($color_name, $hex){
        if($hex != ''){
            $result = Static::where('name', $color_name)->where('hex', $hex)->first();
            if($result){
                return $result->id_car_color;
            }else{
                return Static::insertGetId(array('name' => $color_name, 'hex' => $hex));
            }    
        }else{
            $result = Static::where('name', $color_name)->first();
            if($result){
                return $result->id_car_color;
            }else{
                return Static::insertGetId(array('name' => $color_name, 'hex' => $hex));
            }
        }
        
    }

    public static function getColorInfoByID($id){
        return Static::where('id_car_color', $id)->first();
    }
}