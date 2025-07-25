<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'category',
        'order',
        'is_active'
    ];

    public function scopeForEntrepreneurs($query)
    {
        return $query->where('category', 'entrepreneurs')->where('is_active', true)->orderBy('order');
    }

    public function scopeForConsultants($query)
    {
        return $query->where('category', 'consultants')->where('is_active', true)->orderBy('order');
    }
}
