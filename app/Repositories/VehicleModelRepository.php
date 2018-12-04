<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\VehicleModel;


/**
 * Class VehicleModelRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class VehicleModelRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return VehicleModel::class;
    }
    public function modelsSelect($make_id){
        $models = $this->findWhere(['make_id'=>$make_id]);
        $modelList = array(''=>'Select Option');
        foreach($models as $model)
        {
            $modelList[$model->uuid] = $model->name;
        }
        return $modelList;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
