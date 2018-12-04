<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\VehicleMake;
use DB;

/**
 * Class VehicleMakeRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class VehicleMakeRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return VehicleMake::class;
    }
    public function makesSelect(){

        // $makes = $this->join('listings','listings.make_id','=','vehicle_makes.uuid')->all();
        $makes = DB::table('vehicle_makes')->select('vehicle_makes.name','vehicle_makes.uuid','listings.id_car_make')->join('listings','vehicle_makes.uuid','=','listings.id_car_make')->where('vehicle_makes.status',1)->get();
        $makeList = array(''=>'Select Option');
        foreach($makes as $make)
        {
            $makeList[$make->uuid] = $make->name;
        }
        return $makeList;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
