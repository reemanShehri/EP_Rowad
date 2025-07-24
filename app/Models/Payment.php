<?php

namespace App\Models;

use App\Models\Consultation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'consultation_id',
        'amount',
        'payment_method',
        'transaction_id',
        'status',
        'payment_details',
    ];

    protected $casts = [
        'payment_details' => 'array',
    ];

    // العلاقات
    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }

    // نطاقات الاستعلام (Query Scopes)
    public function scopeSuccessful($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    // طرق مساعدة
    public function isSuccessful()
    {
        return $this->status === 'completed';
    }

    public function getPaymentDetailsAttribute($value)
    {
        return json_decode($value, true) ?? [];
    }

    public function setPaymentDetailsAttribute($value)
    {
        $this->attributes['payment_details'] = json_encode($value);
    }
}
