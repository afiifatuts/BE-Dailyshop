<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreBallanceHistory extends Model
{
    use \App\Traits\UUID;

    protected $fillable = [
        'store_ballance_id',
        'type',
        'reference_id',
        'reference_type',
        'amount',
        'remarks',
    ];

    public function storeBallance()
    {
        return $this->belongsTo(StoreBallance::class);
    }


}
