<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 
        'slug', 
        'description', 
        'image', 
        'is_active'
    ];
    
    protected $casts = [
        'is_active' => 'boolean',
    ];
    
    // Relasi: Satu kategori punya banyak event
    public function events()
    {
        return $this->hasMany(Event::class);
    }
    
    // Scope untuk kategori aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}