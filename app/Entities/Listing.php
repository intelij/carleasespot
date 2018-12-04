<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidModel;

/**
 * Class Listing.
 *
 * @package namespace App\Entities;
 */
class Listing extends Model
{
    use UuidModel;
    public $incrementing = false;
    protected $primaryKey = 'uuid';
    protected $orderBy = 'created_at';
    protected $fillable = [
        'dealer_id','make_id','model_id','state','price','sell_price','type','terms','down_payment','mileage','year','color','featured','status'
    ];
    public function dealer(){
        return $this->belongsTo('App\Entities\User','dealer_id');
    }
    public function make(){
        return $this->belongsTo('App\Entities\VehicleMake','make_id');
    }
    public function model(){
        return $this->belongsTo('App\Entities\VehicleModel','model_id');
    }
}
