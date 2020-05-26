<?php

namespace App\Models;

use App\Events\UserCreated;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;


    protected $dates = [
        'created_at',
        'updated_at',
        'email_verified_at',
    ];


    protected $fillable = [
        'name', 'email', 'password', 'role', 'settings', 'email_verified_at'
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $dispatchesEvents = [
        'created' => UserCreated::class,
    ];



    public function images()
    {
        return $this->hasMany (Image::class);
    }


    public function albums()
    {
        return $this->hasMany (Album::class);
    }


    public function imagesRated()
    {
        return $this->belongsToMany (Image::class);
    }


    public function getAdultAttribute()
    {
        return $this->settings->adult;
    }


    public function getPaginationAttribute()
    {
        return $this->settings->pagination;
    }


    public function getSettingsAttribute($value)
    {
        return json_decode ($value);
    }


    public function getAdminAttribute()
    {
        return $this->role === 'admin';
    }


    public function setAdultAttribute($value)
    {
        $this->attributes['settings'] = json_encode ([
            'adult' => $value,
            'pagination' => $this->settings->pagination
        ]);
    }
}
