<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{HasMany, BelongsToMany};
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Post\{Post, Report};

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;


protected $guarded = ['id', 'created_at', 'updated_at'];


    protected $hidden = ['password', 'remember_token'];


    protected $casts = ['email_verified_at' => 'datetime', 'password' => 'hashed'];

    public function setPasswordAttribute($password): void
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'post_id');
    }

    public function reports(): BelongsToMany
    {
        return $this->belongsToMany(Report::class);
    }

}
