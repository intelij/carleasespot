<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Listings extends Model
{

    /**
     * The DB table name
     *
     * @var string
     */
    protected $table = "listings";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',  'year', 'id_car_make', 'id_car_model', 'id_car_trim', 'id_car_type', 'dealer_id', 'terms', 'price', 'sell_price', 'type', 'down_payment', 'mileage', 'state', 'featured', 'status', 'created_at', 'updated_at'
    ];

    /**
     *
     * Insert Listing
     *
     */
    public static function insertListing($insertArray){
        return Static::insertGetId($insertArray);
    }

    public static function exist_listing($dealer_id, $trim_id){
        return Static::where('dealer_id', $dealer_id)->where('id_car_trim', $trim_id)->get();
    }

    public static function getListingFullInfo($model_id = '', $trim_id = '', $car_type = '', $featured = '', $year = ''){
        $get_min_p_query = \DB::table('listings')->select(\DB::raw('min(price)'));
        if($model_id != ''){
            $get_min_p_query = $get_min_p_query->where('id_car_model', $model_id);
        }
        if($trim_id != ''){
            $get_min_p_query = $get_min_p_query->where('id_car_trim', $trim_id);
        }
        if($car_type != ''){
            $get_min_p_query = $get_min_p_query->where('id_car_type', $car_type);
        }
        if($featured != ''){
            $get_min_p_query = $get_min_p_query->where('featured', $featured);
        }
        if($year != ''){
            $get_min_p_query = $get_min_p_query->where('year', $year);
        }
        $get_min_p_query = self::getRealQuery($get_min_p_query);

        $get_min_sp_query = \DB::table('listings')->select(\DB::raw('min(sell_price)'));
        if($model_id != ''){
            $get_min_sp_query = $get_min_sp_query->where('id_car_model', $model_id);
        }
        if($trim_id != ''){
            $get_min_sp_query = $get_min_sp_query->where('id_car_trim', $trim_id);
        }
        if($car_type != ''){
            $get_min_sp_query = $get_min_sp_query->where('id_car_type', $car_type);
        }
        if($featured != ''){
            $get_min_sp_query = $get_min_sp_query->where('featured', $featured);
        }
        if($year != ''){
            $get_min_sp_query = $get_min_sp_query->where('year', $year);
        }
        $get_min_sp_query = self::getRealQuery($get_min_sp_query);

        $get_max_p_query = \DB::table('listings')->select(\DB::raw('max(price)'));
        if($model_id != ''){
            $get_max_p_query = $get_max_p_query->where('id_car_model', $model_id);
        }
        if($trim_id != ''){
            $get_max_p_query = $get_max_p_query->where('id_car_trim', $trim_id);
        }
        if($car_type != ''){
            $get_max_p_query = $get_max_p_query->where('id_car_type', $car_type);
        }
        if($featured != ''){
            $get_max_p_query = $get_max_p_query->where('featured', $featured);
        }
        if($year != ''){
            $get_max_p_query = $get_max_p_query->where('year', $year);
        }
        $get_max_p_query = self::getRealQuery($get_max_p_query);

        $get_max_sp_query = \DB::table('listings')->select(\DB::raw('max(sell_price)'));
        if($model_id != ''){
            $get_max_sp_query = $get_max_sp_query->where('id_car_model', $model_id);
        }
        if($trim_id != ''){
            $get_max_sp_query = $get_max_sp_query->where('id_car_trim', $trim_id);
        }
        if($car_type != ''){
            $get_max_sp_query = $get_max_sp_query->where('id_car_type', $car_type);
        }
        if($featured != ''){
            $get_max_sp_query = $get_max_sp_query->where('featured', $featured);
        }
        if($year != ''){
            $get_max_sp_query = $get_max_sp_query->where('year', $year);
        }
        $get_max_sp_query = self::getRealQuery($get_max_sp_query);


        $query =  \DB::table('listings as f')->select(\DB::raw("a.*, a.mileage as trim_mileage, b.name as make_name, b.niceName as make_niceName, c.name as model_name, c.model_image as images, c.niceName as model_niceName, d.name as car_type, e.name as car_engine, f.*, g.name as car_engine_size, h.name as transmission_name, (".$get_min_p_query.") as min_price, (".$get_min_sp_query.") as min_sell_price, (".$get_max_p_query.") as max_price, (".$get_max_sp_query.") as max_sell_price "))
            ->leftJoin('car_trim as a', 'a.id_car_trim', '=', 'f.id_car_trim')
            ->leftJoin('car_make as b', 'b.id_car_make','=','f.id_car_make')
            ->leftJoin('car_model as c', 'c.id_car_model','=','f.id_car_model')
            ->leftJoin('car_type as d', 'd.id_car_type','=','f.id_car_type')
            ->leftJoin('car_engine_type as e', 'e.id_engine_type','=','a.engine_type')
            ->leftJoin('car_engine_size as g', 'g.id_engine_size','=','a.engine_size')
            ->leftJoin('car_transmission as h', 'h.id_car_transmission','=','a.transmission');
        if($model_id != ''){
            $query = $query->where('f.id_car_model', $model_id); 
        }
        if($trim_id != ''){
            $query = $query->where('f.id_car_trim', $trim_id); 
        }
        if($car_type != ''){
            $query = $query->where('f.id_car_type', $car_type);
        }
        if($featured != ''){
            $query = $query->where('f.featured', $featured);   
        }
        if($year != ''){
            $query = $query->where('f.year', $year);      
        }
        return $query->groupBy('f.id_car_trim')->get();
    }

    public static function getListing($trim_id = '', $featured = '', $top = ''){
        
        $get_min_p_query = \DB::table('listings')->select(\DB::raw('min(price)'));
        if($trim_id != ''){
            $get_min_p_query = $get_min_p_query->where('id_car_trim', $trim_id);
        }
        if($featured != ''){
            $get_min_p_query = $get_min_p_query->where('featured', $featured);
        }
        if($top != ''){
            $get_min_p_query = $get_min_p_query->where('top', $top);
        }
        $get_min_p_query = self::getRealQuery($get_min_p_query);

        $get_min_sp_query = \DB::table('listings')->select(\DB::raw('min(sell_price)'));
        if($trim_id != ''){
            $get_min_sp_query = $get_min_sp_query->where('id_car_trim', $trim_id);
        }
        if($featured != ''){
            $get_min_sp_query = $get_min_sp_query->where('featured', $featured);
        }
        if($top != ''){
            $get_min_sp_query = $get_min_sp_query->where('top', $top);
        }
        $get_min_sp_query = self::getRealQuery($get_min_sp_query);

        $get_max_p_query = \DB::table('listings')->select(\DB::raw('max(price)'));
        if($trim_id != ''){
            $get_max_p_query = $get_max_p_query->where('id_car_trim', $trim_id);
        }
        if($featured != ''){
            $get_max_p_query = $get_max_p_query->where('featured', $featured);
        }
        if($top != ''){
            $get_max_p_query = $get_max_p_query->where('top', $top);
        }
        $get_max_p_query = self::getRealQuery($get_max_p_query);

        $get_max_sp_query = \DB::table('listings')->select(\DB::raw('max(sell_price)'));
        if($trim_id != ''){
            $get_max_sp_query = $get_max_sp_query->where('id_car_trim', $trim_id);
        }
        if($featured != ''){
            $get_max_sp_query = $get_max_sp_query->where('featured', $featured);
        }
        if($top != ''){
            $get_max_sp_query = $get_max_sp_query->where('top', $top);
        }
        $get_max_sp_query = self::getRealQuery($get_max_sp_query);

        $query =  \DB::table('listings as a')->select(\DB::raw('a.*, b.photo as photo, b.name as name, b.uuid as uuid, c.name as trim_name, c.style_name as trim_style_name, d.name as make_name, e.name as model_name, e.model_image as images, ('.$get_min_p_query.') as min_price, ('.$get_min_sp_query.') as min_sell_price, ('.$get_max_p_query.') as max_price, ('.$get_max_sp_query.') as max_sell_price'))
            ->leftJoin('users as b', 'a.dealer_id', '=', 'b.uuid')
            ->leftJoin('car_trim as c', 'a.id_car_trim', '=', 'c.id_car_trim')
            ->leftJoin('car_make as d', 'a.id_car_make','=','d.id_car_make')
            ->leftJoin('car_model as e', 'a.id_car_model','=','e.id_car_model');
            if($trim_id != ''){
                $query = $query->where('a.id_car_trim', $trim_id);
            }
            if($featured != ''){
                $query = $query->where('featured', $featured);
            }
            if($top != ''){
                $query = $query->where('a.top', $top);
            }
            if($trim_id != '' || $featured != ''){
                $query = $query->orderBy('price','asc')->orderBy('sell_price','asc');
            }
        return $query->get();
    }

    public static function getListing_fullinfo($dealer_id = ''){
        $query =  \DB::table('listings as a')->select(\DB::raw('a.*, b.name as name, b.uuid as uuid, c.name as trim_name, c.style_name as trim_style_name, d.name as make_name, e.name as model_name, e.model_image as images'))
            ->leftJoin('users as b', 'a.dealer_id', '=', 'b.uuid')
            ->leftJoin('car_trim as c', 'a.id_car_trim', '=', 'c.id_car_trim')
            ->leftJoin('car_make as d', 'a.id_car_make','=','d.id_car_make')
            ->leftJoin('car_model as e', 'a.id_car_model','=','e.id_car_model');
            if($dealer_id != ''){
                $query = $query->where('a.dealer_id', $dealer_id);
            }
        return $query->get();
    }

    public static function getListingforDatatable($dealer_id = '', $orders = '', $start = '', $length = '', $search = '', $get = ''){
        $query =  \DB::table(\DB::raw('(SELECT @i := '.intVal($start).') initvar, listings as a'))->select(\DB::raw('@i := @i + 1 ranking, a.*, b.name as name, b.uuid as uuid, c.name as trim_name, c.style_name as trim_style_name, d.name as make_name, e.name as model_name, e.model_image as images'))
            ->leftJoin('users as b', 'a.dealer_id', '=', 'b.uuid')
            ->leftJoin('car_trim as c', 'a.id_car_trim', '=', 'c.id_car_trim')
            ->leftJoin('car_make as d', 'a.id_car_make','=','d.id_car_make')
            ->leftJoin('car_model as e', 'a.id_car_model','=','e.id_car_model');
        if($dealer_id != ''){
            $query = $query->where('a.dealer_id', $dealer_id);
        }
        if($search != ''){
            $query = $query->where(function($q) use ($search){
                $q->where('d.name','like','%'.$search.'%')
                    ->orWhere('e.name','like','%'.$search.'%')
                    ->orWhere('e.name','like','%'.$search.'%')
                    ->orWhere('c.style_name','like','%'.$search.'%')
                    ->orWhere('a.mileage','like','%'.$search.'%')
                    ->orWhere('a.year','like','%'.$search.'%');
            });
        }
        if($orders != ''){
            foreach($orders as $order){
                if($order['column'] == 1){
                    $query->orderBy('d.name', $order['dir']);
                }elseif($order['column'] == 2){
                    $query->orderBy('e.name', $order['dir']);
                }elseif($order['column'] == 3){
                    $query->orderBy('c.style_name', $order['dir']);
                }elseif($order['column'] == 4){
                    $query->orderBy('a.type', $order['dir']);
                }elseif($order['column'] == 5){
                    $query->orderBy('a.mileage', $order['dir']);
                }elseif($order['column'] == 6){
                    $query->orderBy('a.year', $order['dir']);
                }elseif($order['column'] == 7){
                    $query->orderBy('d.featured', $order['dir']);
                }elseif($order['column'] == 8){
                    $query->orderBy('d.top', $order['dir']);
                }elseif($order['column'] == 9){
                    $query->orderBy('d.status', $order['dir']);
                }
            }
        }
        if($start != ''){
            $query->skip($start);
        }
        if($length != ''){
            $query->take($length);
        }
        if($get == 'count'){
            return $query->count();
        }else{
            return $query->get();
        }

    }

    public static function indexlisting($dealerid){
        $dealerid = "'".$dealerid."'";
        $get_min_p_query = \DB::table("listings")->select(\DB::raw("min(price)"));
        if($dealerid != ""){
            $get_min_p_query = $get_min_p_query->where("dealer_id", $dealerid);
        }
        $get_min_p_query = self::getRealQuery($get_min_p_query);
        
        $get_min_sp_query = \DB::table("listings")->select(\DB::raw("min(sell_price)"));
        if($dealerid != ""){
            $get_min_sp_query = $get_min_sp_query->where("dealer_id", $dealerid);
        }
        $get_min_sp_query = self::getRealQuery($get_min_sp_query);

        $get_max_p_query = \DB::table("listings")->select(\DB::raw("max(price)"));
        if($dealerid != ""){
            $get_max_p_query = $get_max_p_query->where("dealer_id", $dealerid);
        }
        $get_max_p_query = self::getRealQuery($get_max_p_query);

        $get_max_sp_query = \DB::table("listings")->select(\DB::raw("max(sell_price)"));
        if($dealerid != ""){
            $get_max_sp_query = $get_max_sp_query->where("dealer_id", $dealerid);
        }
        $get_max_sp_query = self::getRealQuery($get_max_sp_query);

        $query =  \DB::table("listings as a")->select(\DB::raw("a.*, c.name as trim_name, c.style_name as trim_style_name, d.name as make_name, e.name as model_name, e.model_image as images,a.dealer_id as uuid, (".$get_min_p_query.") as min_price, (".$get_min_sp_query.") as min_sell_price, (".$get_max_p_query.") as max_price, (".$get_max_sp_query.") as max_sell_price"))
            ->leftJoin("car_trim as c", "a.id_car_trim", "=", "c.id_car_trim")
            ->leftJoin("car_make as d", "a.id_car_make","=","d.id_car_make")
            ->leftJoin("car_model as e", "a.id_car_model","=","e.id_car_model");
            if($dealerid != ""){
                $query = $query->whereRaw("a.dealer_id = ".$dealerid);
            }
            
        return $query->get();
    }
    
    public static function featuredlisting($dealerid){
        $dealerid = "'".$dealerid."'";
        $get_min_p_query = \DB::table("listings")->select(\DB::raw("min(price)"));
        if($dealerid != ""){
            $get_min_p_query = $get_min_p_query->where("dealer_id", $dealerid);
            $get_min_p_query = $get_min_p_query->where("featured", 1);
        }
        $get_min_p_query = self::getRealQuery($get_min_p_query);

        $get_min_sp_query = \DB::table("listings")->select(\DB::raw("min(sell_price)"));
        if($dealerid != ""){
            $get_min_sp_query = $get_min_sp_query->where("dealer_id", $dealerid);
            $get_min_sp_query = $get_min_sp_query->where("featured", 1);
        }
        $get_min_sp_query = self::getRealQuery($get_min_sp_query);

        $get_max_p_query = \DB::table("listings")->select(\DB::raw("max(price)"));
        if($dealerid != ""){
            $get_max_p_query = $get_max_p_query->where("dealer_id", $dealerid);
            $get_max_p_query = $get_max_p_query->where("featured", 1);
        }
        $get_max_p_query = self::getRealQuery($get_max_p_query);

        $get_max_sp_query = \DB::table("listings")->select(\DB::raw("max(sell_price)"));
        if($dealerid != ""){
            $get_max_sp_query = $get_max_sp_query->where("dealer_id", $dealerid);
            $get_max_sp_query = $get_max_sp_query->where("featured", 1);
        }
        $get_max_sp_query = self::getRealQuery($get_max_sp_query);

        $query =  \DB::table("listings as a")->select(\DB::raw("a.*, c.name as trim_name, c.style_name as trim_style_name, d.name as make_name, e.name as model_name, e.model_image as images,a.dealer_id as uuid, (".$get_min_p_query.") as min_price, (".$get_min_sp_query.") as min_sell_price, (".$get_max_p_query.") as max_price, (".$get_max_sp_query.") as max_sell_price"))
            ->leftJoin("car_trim as c", "a.id_car_trim", "=", "c.id_car_trim")
            ->leftJoin("car_make as d", "a.id_car_make","=","d.id_car_make")
            ->leftJoin("car_model as e", "a.id_car_model","=","e.id_car_model");
            if($dealerid != ""){
                $query = $query->whereRaw("a.dealer_id = ".$dealerid);
                $query = $query->where("a.featured", 1);
            }
            
        return $query->get();
    }
    
    
     public static function inactivelisting($dealerid){
         $dealerid = "'".$dealerid."'";
        $get_min_p_query = \DB::table("listings")->select(\DB::raw("min(price)"));
        if($dealerid != ""){
            $get_min_p_query = $get_min_p_query->where("dealer_id", $dealerid);
            $get_min_p_query = $get_min_p_query->where("status", 1);
        }
        $get_min_p_query = self::getRealQuery($get_min_p_query);

        $get_min_sp_query = \DB::table("listings")->select(\DB::raw("min(sell_price)"));
        if($dealerid != ""){
            $get_min_sp_query = $get_min_sp_query->where("dealer_id", $dealerid);
            $get_min_sp_query = $get_min_sp_query->where("status", 1);
        }
        $get_min_sp_query = self::getRealQuery($get_min_sp_query);

        $get_max_p_query = \DB::table("listings")->select(\DB::raw("max(price)"));
        if($dealerid != ""){
            $get_max_p_query = $get_max_p_query->where("dealer_id", $dealerid);
            $get_max_p_query = $get_max_p_query->where("status", 1);
        }
        $get_max_p_query = self::getRealQuery($get_max_p_query);

        $get_max_sp_query = \DB::table("listings")->select(\DB::raw("max(sell_price)"));
        if($dealerid != ""){
            $get_max_sp_query = $get_max_sp_query->where("dealer_id", $dealerid);
            $get_max_sp_query = $get_max_sp_query->where("status", 1);
        }
        $get_max_sp_query = self::getRealQuery($get_max_sp_query);

        $query =  \DB::table("listings as a")->select(\DB::raw("a.*, c.name as trim_name, c.style_name as trim_style_name, d.name as make_name, e.name as model_name, e.model_image as images,a.dealer_id as uuid, (".$get_min_p_query.") as min_price, (".$get_min_sp_query.") as min_sell_price, (".$get_max_p_query.") as max_price, (".$get_max_sp_query.") as max_sell_price"))
            ->leftJoin("car_trim as c", "a.id_car_trim", "=", "c.id_car_trim")
            ->leftJoin("car_make as d", "a.id_car_make","=","d.id_car_make")
            ->leftJoin("car_model as e", "a.id_car_model","=","e.id_car_model");
            if($dealerid != ""){
                $query = $query->whereRaw("a.dealer_id = ".$dealerid);
                $query = $query->where("a.status", 1);
            }
            
        return $query->get();
    }
    
    public static function updateListing($id, $update_array){
        return Static::where('id', $id)->update($update_array);
    }

    public static function deleteListing($id){
        return Static::where('id', $id)->delete();
    }

    public static function getListingByID($id){
        return \DB::table('listings as a')->select(\DB::raw('a.*, b.name as name, b.uuid as uuid, b.email as email, c.name as trim_name, c.style_name as trim_style_name, d.name as make_name, e.name as model_name, e.model_image as images'))
            ->leftJoin('users as b', 'a.dealer_id', '=', 'b.uuid')
            ->leftJoin('car_trim as c', 'a.id_car_trim', '=', 'c.id_car_trim')
            ->leftJoin('car_make as d', 'a.id_car_make','=','d.id_car_make')
            ->leftJoin('car_model as e', 'a.id_car_model','=','e.id_car_model')
            ->where('a.id', $id)->first();
    }

    public static function getExistListing($dealer_id, $id_car_trim){
        return Static::where('dealer_id', $dealer_id)->where('id_car_trim', $id_car_trim)->first();
    }

    public static function getRealQuery($query, $dumpIt = false)
    {
        $params = array_map(function ($item) {
            return $item;
        }, $query->getBindings());
        $result = str_replace_array('?', $params, $query->toSql());
        if ($dumpIt) {
            dd($result);
        }
        return $result;
    }
}