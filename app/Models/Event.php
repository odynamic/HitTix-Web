<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

protected $fillable = [
    'user_id',
    'description',
    'event_date',
    'location',
    'capacity',
    'price',
    'image',
    'status',
    'category',
    'package',
    'active_until',
    'published_at',
];
protected $casts = [
    'event_date' => 'datetime',
    'published_at' => 'datetime',
    'active_until' => 'datetime',
];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function isActive()
{
    return $this->status === 'published' && $this->active_until > now();
}


    public function orders()
    {
        return $this->hasMany(\App\Models\Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
