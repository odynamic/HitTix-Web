<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'total_amount',
        'status',
        'payment_method',
        'payment_proof',
        'notes',
        'expired_at',
        'paid_at'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'expired_at' => 'datetime',
        'paid_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }


    public function tickets()
    {
        return $this->hasManyThrough(Ticket::class, OrderItem::class, 'order_id', 'id', 'id', 'ticket_id');
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function getFormattedTotalAttribute()
    {
        return 'Rp ' . number_format($this->total_amount, 0, ',', '.');
    }

    public static function generateOrderNumber()
    {
        $prefix = 'HT';
        $date = now()->format('ymd');
        $lastOrder = self::whereDate('created_at', today())->orderBy('id', 'desc')->first();
        $number = $lastOrder ? (int)substr($lastOrder->order_number, -4) + 1 : 1;
        return $prefix . $date . str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    public function isExpired()
    {
        return $this->expired_at && now()->gt($this->expired_at) && $this->status === 'pending';
    }
}
