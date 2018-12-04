<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarImageFrmRequest;
use App\Repositories\CarImageRepository;
use App\Repositories\VehicleMakeRepository;
use App\Repositories\VehicleModelRepository;
use Session;
use Response;
use Request;
use Image;
use File;
class CarImageController extends Controller
{
    private $repository,$make_repository,$model_repository;
    public function __construct(CarImageRepository $repository,VehicleMakeRepository $make_repository,VehicleModelRepository $model_repository)
    {
        $this->repository = $repository;
        $this->make_repository = $make_repository;
        $this->model_repository = $model_repository;
    }
    public function index()
    {
        $images = $this->repository->group_all();
        return view('backend.car_images.index',compact('images'));
    }
    public function edit($uuid){
        $row = $this->repository->find($uuid);
        $makes = $this->make_repository->makesSelect();
        $models = $this->model_repository->modelsSelect($row->make_id);
        $car_images = $this->repository->findWhere(['make_id'=>$row->make_id,'model_id'=>$row->model_id]);
        $make = $row->make_id;
        $model = $row->model_id;
        return view('backend.car_images.edit',compact('makes','models','car_images','make','model'));
    }
    public function create()
    {
        $makes = $this->make_repository->makesSelect();
        return view('backend.car_images.create',compact('makes'));
    }
    public function store(CarImageFrmRequest $request){
        $make = $request->get('make');
        $model = $request->get('model');
        $trim = $request->get('trim');
        if($request->hasFile('car_images')){
            if (!file_exists('assets/car_images/' .$make.$model)) {
                mkdir('assets/car_images/'.$make.$model, 0755, true);
            }
            foreach ($request->file('car_images') as $file) {
                if($file->getClientOriginalName() != '') {
                    $filename = strtolower(str_random(50) . '.' . $file->getClientOriginalExtension());
                    $file->move('assets/car_images/'.$make.$model, $filename);

                    //$filename = strtolower(str_random(50) . '.' . $file->getClientOriginalExtension());
                    //$image  = Image::make($file->getRealPath());
                    /*$image->fit(800, 600, function ($constraint) {
                        $constraint->upsize();
                    });*/
                    //$image->save('assets/car_images/'.$make.$model.'/'.$filename);
                    $file_data = array('make_id' => $make,'model_id' => $model,'trim' => $trim,  'file_name' => $filename);
                    $this->repository->create($file_data);
                }
            }
            return Response::json(array('success' => true, 'msg' => 'Car Images updated successfully'), 200);
        }else{
            return Response::json(array('success' => false, 'msg' => 'Car Images update failed'), 422);
        }
    }
    public function ajax_delete(){
        $uuid = Request::input('key');
        $image = $this->repository->find($uuid);
        if(File::delete('assets/car_images/' .$image->make_id.$image->model_id.'/'.$image->file_name)){
            $image->delete();
            return response()->json(['success'=>true], 200);
        }else{
            return response()->json(['success'=>false,'message'=>'unable to delete this image'], 422);
        }
    }
    public function reorder_images(){
        $items = Request::input('items');
        foreach ($items as $count=>$item){
            $this->repository->update(['image_order'=>$count+1],$item);
        }
    }

}
