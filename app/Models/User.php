<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\QueuedResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'fat_percent',
        'kcal_per_day_normal',
        'fat_percent',
        'BMR',
        'BMI',
        'breakfast_percent',
        'lunch_percent',
        'dinner_percent',
        'snack_percent',
        'product_hash',
        'kcal_per_day',
        'sex',
        'growth_cm',
        'activity_coefficient',
        'birthday_date',
        'target_kg',
        'deficit_kcal',
    ];

    public $appends = [

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
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

    public function foodIntakes()
    {
        return $this->hasMany(FoodIntake::class);
    }

    public function measurements()
    {
        return $this->hasMany(Measurement::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Send the password reset notification via queue.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new QueuedResetPassword($token));
    }
}
