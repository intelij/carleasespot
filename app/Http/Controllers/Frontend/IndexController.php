<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\ListingRepository;
use App\Repositories\CarImageRepository;
use App\Repositories\VehicleMakeRepository;
use App\Model\CarMake;
use App\Model\CarModel;
use App\Model\CarType;
use App\Model\Listings;
class IndexController extends Controller
{
    private $listing_repository,$car_image_repository,$make_repository;
    public function __construct(ListingRepository $listing_repository, CarImageRepository $car_image_repository,VehicleMakeRepository $make_repository)
    {
        $this->listing_repository = $listing_repository;
        $this->car_image_repository = $car_image_repository;
        $this->make_repository = $make_repository;
    }
    public function index(){
        $listings = Listings::getListingFullInfo('','','',1);
        $vehicle_makes = CarMake::getAllMakes();
        $makes = array();
        $makes[''] = 'Select Option';
        $makes_forsearch = array();
        foreach($vehicle_makes as $make){
            $makes[$make->id_car_make] = $make->name;
            $makes_forsearch[] = array(
                'value' => route('frontend.make', ['id' => $make->id_car_make]),
                'label' => $make->name
            );
        }
        


        $models_arr = CarModel::getAllModelsWithMakeName();
        $models_forsearch = array();

        foreach($models_arr as $model){
            $models_forsearch[] = array(
                'value' => route('frontend.model', ['id' => $model->id_car_model]),
                'label' => $model->year.' '.$model->make_name.' '.$model->name
            );
        }
        $search_content = array_merge($makes_forsearch, $models_forsearch);
        
        $car_types = CarType::getAllCarType();
        foreach($listings as $count=>$listing){
            $image = $this->car_image_repository->findWhere(['make_id'=>$listing->id_car_make,'model_id'=>$listing->id_car_model])->first();
            $listings[$count]->image = asset($image ? 'assets/car_images/'.$image->id_car_make.$image->id_car_model.'/'.$image->file_name : 'assets/car_images/no-image.png');
        }
        return view('frontend.home.index', compact('listings','makes','vehicle_makes','car_types', 'search_content'));
    }
}
