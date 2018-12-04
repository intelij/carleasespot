<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{

    /**
     * The DB table name
     *
     * @var string
     */
    protected $table = "users";


    /**
     *
     * Get All CarType
     *
     * @return array
     */
    public static function getAllDealerwithListing(){
        return \DB::table('users as a')->select(\DB::raw('*, (select count(id) from listings as b where a.uuid = b.dealer_id) as listing_count'))->where('status', 1)->where('type','dealer')->get();
    }
}