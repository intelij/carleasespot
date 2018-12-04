<?php

namespace App\Entities;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\UuidModel;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User.
 *
 * @package namespace App\Entities;
 */
class User extends Authenticatable
{
    use UuidModel;
    use Notifiable;
    public $incrementing = false;
    protected $primaryKey = 'uuid';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','phone','address', 'password', 'photo','status','activation_code','type','city', 'state', 'pincode'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function listings(){
        return $this->hasMany('App\Entities\Listing','dealer_id');
    }
    public function Inquiries(){
        return $this->hasMany('App\Entities\Inquiry','dealer_id');
    }

}
