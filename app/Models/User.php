<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
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
        'roles',
        'image_id',
        'first_name',
        'last_name',
        'phone',
        'provider',
        'provider_id',
        'provider_token',
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


    public function news()
    {
        return $this->hasMany(News::class);
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function image()
    {
        return $this->belongsTo(Images::class, 'image_id');
    }

    public function isAdmin()
    {
        return $this->roles === 'admin';
    }

    public function isEditor()
    {
        return $this->roles === 'editor';
    }

    public function isReporter()
    {
        return $this->roles === 'reporter';
    }
}
