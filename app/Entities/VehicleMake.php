<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidModel;
use DB;
/**
 * Class VehicleMake.
 *
 * @package namespace App\Entities;
 */
class VehicleMake extends Model
{
    use UuidModel;
    public $incrementing = false;
    protected $primaryKey = 'uuid';
    protected $orderBy = 'created_at';
    protected $fillable = [
        'name','logo','status'
    ];
    public function models(){
        return $this->hasMany('App\Entities\VehicleModel','make_id');
    }


    public static function listing(){
        return VehicleMake::select(
                'vehicle_makes.name as make',
                'vehicle_models.name as model',
                'car_trim.name as trim',
                'car_serie.name as body_type',
                'car_trim.id_car_trim',
                'vehicle_makes.id_car_make',
                'vehicle_models.id_car_model',
                'vehicle_models.uuid as  model_id' ,
                "vehicle_models.make_id",
                "listings.terms",
                "listings.price",
                "listings.sell_price",
                "listings.down_payment",
                "listings.mileage",
                "listings.year",
                "listings.featured" ,
                "listings.state"
                
            )
            ->join('vehicle_models','vehicle_models.make_id','=','vehicle_makes.uuid')
            ->join('car_trim','car_trim.id_car_model','=','vehicle_models.id_car_model')
            ->join('listings','listings.id_car_make','=','vehicle_makes.uuid')
            ->join('car_serie','car_serie.id_car_model','=','vehicle_models.id_car_model')
            // ->whereIn('listings.year',["2017","2018"])
            ->groupBy('car_trim.id_car_trim');
    }
}
