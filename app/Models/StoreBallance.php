<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class StoreBallance extends Model
{
    use UUID;

    protected $fillable = [
        'store_id',
        'ballance',
    ];

    protected $casts = [
        'ballance' => 'decimal:2',
    ];

    // StoreBallance is owned by a Store
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function storeBallanceHistories()
    {
        return $this->hasMany(StoreBallanceHistory::class);
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class);
    }
}
