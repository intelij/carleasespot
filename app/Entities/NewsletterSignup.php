<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidModel;

/**
 * Class NewsletterSignup.
 *
 * @package namespace App\Entities;
 */
class NewsletterSignup extends Model
{
    use UuidModel;
    public $incrementing = false;
    protected $primaryKey = 'uuid';
    protected $orderBy = 'created_at';
    protected $fillable = [
        'email','status'
    ];

}
