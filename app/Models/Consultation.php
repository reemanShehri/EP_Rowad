<?php

namespace App\Models;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'consultant_id',
        'entrepreneur_id',
        'topic',
        'description',
        'scheduled_at',
        'duration',
        'price',
        'status',
        'meeting_link',
        'payment_status',
        'user_id',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    // العلاقات
    public function consultant()
    {
        return $this->belongsTo(User::class, 'consultant_id');
    }

    public function entrepreneur()
    {
        return $this->belongsTo(User::class, 'entrepreneur_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    // نطاقات الاستعلام (Query Scopes)
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('scheduled_at', '>', now())
                    ->where('status', 'confirmed');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    // طرق مساعدة
    public function isConfirmed()
    {
        return $this->status === 'confirmed';
    }

    public function isPaid()
    {
        return $this->payment_status === 'paid';
    }
}
