<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'user_id',
        'order_id',
        'gross_amount',
        'status',
    ];

    // Jika ada relasi ke user:
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
