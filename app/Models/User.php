<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_name',
        'email',
        'phone',
        'password',
        'status',
    ];

    protected $dates = ['deleted_at']; // Ensure `deleted_at` is treated as a date

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

    // get the orders for teh user:
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // get the addresses for the user

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

     /**
     * Get the most recent address of the user.
     */
    public function latestAddress()
    {
        return $this->hasOne(Address::class)->latest();
    }
}
