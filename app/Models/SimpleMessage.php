<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimpleMessage extends Model
{
    use HasFactory;

    /**
     * الحقول التي يمكن تعبئتها جماعيًا
     */
    protected $fillable = [
        'user_id',
        'content'
    ];

    /**
     * العلاقة مع نموذج User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * الحقول التي يجب إخفاؤها عند التحويل إلى مصفوفة أو JSON
     */
    protected $hidden = [
        'updated_at'
    ];

    /**
     * القيم الافتراضية لسمات النموذج
     */
    protected $attributes = [
        'content' => '', // قيمة افتراضية فارغة للمحتوى
    ];
}
