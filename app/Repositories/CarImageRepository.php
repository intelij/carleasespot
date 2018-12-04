<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\CarImage;
use DB;
/**
 * Class CarImageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CarImageRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CarImage::class;
    }

    public function group_all(){
        $data = DB::table("car_images")->select('car_images.uuid',DB::raw("COUNT(car_images.make_id) as images_num,vehicle_makes.name as make_name,vehicle_models.name as model_name"))->join('vehicle_makes','car_images.make_id','=', 'vehicle_makes.uuid')->join('vehicle_models','car_images.model_id','=', 'vehicle_models.uuid')->groupBy('car_images.make_id','car_images.model_id')->get();
        return $data;
    }




    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
