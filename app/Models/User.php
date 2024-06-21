<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
    // Relationship with Posts
    public function posts()
    {
    return $this->hasMany(Post::class);
    }
    // Relationship with Likes
    public function likes()
    {
    return $this->hasMany(Like::class);
    }
     // Relationship with Profiles
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    //Relationship with followers
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'followed_user_id', 'user_id');
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'followed_user_id');
    }
    // Relationship with Messages
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }
    // Relationship with Interests
    public function interests()
    {
        return $this->belongsToMany(Interest::class);
    }
}

