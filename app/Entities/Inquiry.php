<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidModel;


/**
 * Class Inquiry.
 *
 * @package namespace App\Entities;
 */
class Inquiry extends Model
{
    use UuidModel;
    public $incrementing = false;
    protected $primaryKey = 'uuid';
    protected $orderBy = 'created_at';
    protected $fillable = [
        'first_name','last_name','email','phone','message','listing_id', 'dealer_id','price','type','car','ip_address'
    ];
    public function dealer(){
        return $this->belongsTo('App\Entities\User','dealer_id');
    }
}
