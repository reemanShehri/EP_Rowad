<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Like;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Message;
use App\Models\Consultation;
use App\Models\Conversation;
use App\Models\SimpleMessage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
   protected $fillable = [
    'name',
    'email',
    'password',
    'bio',
    'user_type',
    'avatar',
    'specialization',
    'experience',
    'whatsapp',
    'role'
];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }





    public function conversations()
{
    return $this->belongsToMany(Conversation::class, 'conversation_participants')
                ->withTimestamps();
}

public function messages()
{
    return $this->hasMany(Message::class);
}


// في app/Models/User.php
public function simpleMessages()
{
    return $this->hasMany(SimpleMessage::class);
}

    // أضف هذه العلاقات إلى نموذج User
public function posts()
{
    return $this->hasMany(Post::class);
}

public function comments()
{
    return $this->hasMany(Comment::class);
}

public function likes()
{
    return $this->hasMany(Like::class);
}

// للمرحلة الثانية
public function consultations()
{
    return $this->hasMany(Consultation::class, 'consultant_id');
}

public function bookedConsultations()
{
    return $this->hasMany(Consultation::class, 'entrepreneur_id');
}

public function isConsultant()
{
    return $this->user_type === 'consultant';
}

public function isEntrepreneur()
{
    return $this->user_type === 'entrepreneur';
}


public function upcomingConsultations()
{
    return $this->consultations()->upcoming();
}

public function completedConsultations()
{
    return $this->consultations()->completed();
}
}
