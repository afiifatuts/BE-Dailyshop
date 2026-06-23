<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use UUID;

    protected $fillable = [
        'user_id',
        'name',
        'logo',
        'about',
        'phone',
        'address_id',
        'city',
        'address',
        'postal_code',
        'is_verified'
    ];
}
