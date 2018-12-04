<?php

namespace App\Entities;

use App\Notifications\AdminResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\UuidModel;
class Admin extends Authenticatable
{
    use UuidModel;
    use Notifiable;
    public $incrementing = false;
    protected $primaryKey = 'uuid';
    protected $guard = 'admin';
    protected $fillable = [
        'name','username', 'email', 'password', 'photo','status'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function sendPasswordResetNotification($token){
        $this->notify(new AdminResetPassword($token));
    }

}
