<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class States extends Model
{

    /**
     * The DB table name
     *
     * @var string
     */
    protected $table = "states";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',  'state', 'short_name'
    ];

    /**
     *
     * Get All CarType
     *
     * @return array
     */
    public static function getAllStates(){
        return Static::orderBy('id', 'asc')->get();
    }

    public static function getStateInfoByID($id){
        return Static::where('id', $id)->first();
    }

    public static function getStateInfoByName($name){
        return Static::where('state', $name)->orWhere('short_name', $name)->first();
    }
}