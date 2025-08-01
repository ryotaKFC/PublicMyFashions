<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
    ];

    public function fashions(){
        return $this->belongsTo(User::class);
    }
    public function bookmarks(){
        return $this->hasMany(Bookmark::class);
    }
    public function bookmark_fashions(){
        return $this->belongsToMany(Fashion::class, 'bookmarks', 'user_id', 'fashion_id');
    }

    public function is_bookmark($fashionId){
        return $this->bookmarks()->where('fashion_id', $fashionId)->exists();
    }
}
