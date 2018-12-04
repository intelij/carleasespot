<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ListingFrmRequest;
use App\Repositories\ListingRepository;
use App\Repositories\InquiryRepository;
use App\Repositories\VehicleMakeRepository;
use App\Repositories\CarImageRepository;
use App\Repositories\VehicleModelRepository;
use App\Model\CarMake;
use App\Model\CarModel;
use App\Model\CarTrim;
use App\Model\Listings;
use App\Model\States;
use App\Model\Users;
use Mail;
Use Response;
use Session;
use Request;
class ListingController extends Controller
{
    private $repository,$inquiry_repository,$make_repository,$car_image_repository,$model_repository;
    public function __construct(ListingRepository $repository,VehicleMakeRepository $make_repository,VehicleModelRepository $model_repository)
    {
        $this->repository = $repository;
		$this->make_repository = $make_repository;
		$this->model_repository = $model_repository;
    }
    public function index(){

        $dealers = Users::getAllDealerwithListing();
        
        //$listings = Listings::getListing();
	
        return view('backend.listings.index', compact('dealers'));
    }
    public function show($uuid){
        //$listings = Listings::getListing_fullinfo($uuid);

        //return view('backend.listings.listing', compact('listings'));

        return view('backend.listings.listing', compact('uuid'));
    }
    public function create(){
        return view('backend.listings.create');
    }
	public function edit($id){
        $listing = Listings::getListingByID($id);
        $makes_arr = CarMake::getAllMakes();
        $makes = array();
        $makes[''] = 'Select Option';
        foreach($makes_arr as $make){
            $makes[$make->id_car_make] = $make->name;
        }

        $models_arr = CarModel::getModelsByMake($listing->id_car_make, $listing->year);
        $mdoels = array();
        $models[''] = 'Select Option';
        foreach($models_arr as $model){
            $models[$model->id_car_model] = $model->name;
        }

        $trims_arr = CarTrim::getTrimsByModelID($listing->id_car_model, $listing->year);
        $trims = array();
        $trims[''] = 'Select Option';
        foreach($trims_arr as $trim){
            $trims[$trim->id_car_trim] = $trim->style_name;
        }

        $states_arr = States::getAllStates();
        $states = array();
        foreach($states_arr as $state){
            $states[$state->id] = $state->state;
        }

        return view('backend.listings.edit',compact('makes','listing','models', 'trims', 'states'));
    }
    public function update(ListingFrmRequest $request,$id){
        if(count(Request::state)>6)
        {
            Session::flash('error','select only 6 states or select all states');
            return redirect()->route('admin.listings.index');   
        }
        $car_info = CarTrim::getTrimByID(Request::trim);
        $data = [
            'year' => Request::year,
            'id_car_make' => Request::make,
            'id_car_model' => Request::model,
            'id_car_trim' => Request::trim,
            'id_car_type' => $car_info->id_car_type,
            'price' => Request::price,
            'sell_price' => Request::sell_price,
            'down_payment' => floatval(str_replace(',','',Request::down_payment)),
            'mileage' => floatval(str_replace(',','',Request::mileage)),
            'type' => Request::type,
            'state' => implode(',', Request::state),
            'terms'=>Request::terms
        ];
        if(Listings::updateListing($id, $data)){
            Session::flash('success','Listing saved successfully');
            return redirect()->route('admin.listings.index');
        }else{
            Session::flash('error','Listing edition failed');
            return redirect()->route('admin.listings.index');
        }
    }
    public function toggle_featured(){
        $id = Request::input('list_id');
        $trim_id = Request::input('trim_id');
        $featured = Request::input('featured');
        if((int)$featured == 1){
            $listing_info = Listings::getListing((int)$trim_id, $featured);
            if(count($listing_info) > 0 && $listing_info[0]->id != null){
                return 'exits';
            }
        }
        Listings::updateListing($id, array('featured' => $featured));
        return 'success';
    }
    public function toggle_top(){
        $id = Request::input('list_id');
        $trim_id = Request::input('trim_id');
        $top = Request::input('top');
        if((int)$top == 1){
            $listing_info = Listings::getListing((int)$trim_id, '', $top);
            if(count($listing_info) > 2){
                return 'exits';
            }
        }
        Listings::updateListing($id, array('top' => $top));
        return 'success';
    }
    public function toggle_status(){
        $id = Request::input('key');
        $status = Request::input('status');
        Listings::updateListing($id, array('status' => $status));
        return 'success';   
    }
	public function destroy($id){
        if(Listings::deleteListing($id)){
            Session::flash('success','Listing deleted successfully');
        }else{
            Session::flash('error','Listing deletion failed');
        }
        return redirect()->route('admin.listings.index');
    }

    public function getList(){

        $draw = Request::input('draw');
        $columns= Request::input('columns');
        $order = Request::input('order');
        $start = Request::input('start');
        $length = Request::input('length');
        $search = Request::input('search');
        $dealer_id = Request::input('dealer_id');
        $recordsFiltered = 0;
        $recordsTotal = 0;
        $recordsFiltered = Listings::getListingforDatatable($dealer_id, $order, '', '', $search['value'], 'count');
        $recordsTotal = Listings::getListingforDatatable($dealer_id, $order, '', '', '', 'count');

        $datas = Listings::getListingforDatatable($dealer_id, $order, $start, $length, $search['value']);
        $data = array();
        $count = 0;
        foreach($datas as $info_data){
            if($info_data->featured == 1){
                $featured = '<input type="checkbox" class="js-switch feature" checked data-switchery="true" value="'.$info_data->id.','.$info_data->id_car_trim.'">';    
            }else{
                $featured = '<input type="checkbox" class="js-switch feature" data-switchery="true" value="'.$info_data->id.','.$info_data->id_car_trim.'">';    
            }
            if($info_data->top == 1){
                $top = '<input type="checkbox" class="js-switch top_listing" checked data-switchery="true" value="'.$info_data->id.','.$info_data->id_car_trim.'">';
            }else{
                $top = '<input type="checkbox" class="js-switch top_listing" data-switchery="true" value="'.$info_data->id.','.$info_data->id_car_trim.'">';
            }
            
            if($info_data->status == 1){
                $status = '<input type="checkbox" class="js-switch active" checked data-switchery="true" value="'.$info_data->id.'">';
            }else{
                $status = '<input type="checkbox" class="js-switch active" data-switchery="true" value="'.$info_data->id.'">';
            }
            
            
            $active_edit = '<a href="'.route('admin.listings.edit',$info_data->id).'" class="edit_btn" ><i class="fa fa-pencil" style="font-size:24px; border: 1px solid ;background-color: skyblue;"></i></a>';
            $active_delete = delete_btn('admin.listings.destroy', $info_data->id);

            $data[$count] = array($info_data->ranking, $info_data->make_name, $info_data->model_name, $info_data->trim_style_name, $info_data->type == 1? 'Buy': 'Sell', $info_data->mileage, $info_data->year, $featured, $top, $status, $active_edit.$active_delete);
            $count++;
        }
        
        return json_encode(array('data' => $data, 'draw' => $draw, 'recordsFiltered' => $recordsFiltered, 'recordsTotal' => $recordsTotal));

    }
}
