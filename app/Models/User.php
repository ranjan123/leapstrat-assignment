<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'first',
        'last',
        'email'
    ];

    /**
     * The function return the user details
     */
    public function user_details(): HasOne
    {
        return $this->hasOne(UserDetails::class);
    }

    /**
     * The function return the user location
     */
    public function user_location(): HasOne
    {
        return $this->hasOne(UserDetails::class);
    }
}
