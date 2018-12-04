<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidModel;

/**
 * Class VehicleModel.
 *
 * @package namespace App\Entities;
 */
class VehicleModel extends Model
{
    use UuidModel;
    public $incrementing = false;
    protected $primaryKey = 'uuid';
    protected $orderBy = 'created_at';
    protected $fillable = [
        'name','make_id','status'
    ];
    public function make(){
        return $this->belongsTo('App\Entities\VehicleMake','make_id');
    }
}
