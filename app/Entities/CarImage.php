<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidModel;

/**
 * Class CarImage.
 *
 * @package namespace App\Entities;
 */
class CarImage extends Model
{
    use UuidModel;
    public $incrementing = false;
    protected $primaryKey = 'uuid';
    protected $orderBy = 'created_at';
    protected $fillable = [
        'make_id','model_id','file_name','status','image_order'
    ];
    public function make(){
        return $this->belongsTo('App\Entities\VehicleMake','make_id');
    }
    public function model(){
        return $this->belongsTo('App\Entities\VehicleModel','model_id');
    }
}
