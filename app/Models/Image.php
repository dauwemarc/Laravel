<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    public function category()
    {
        return $this->belongsTo (Category::class);
    }


    public function albums()
    {
        return $this->belongsToMany (Album::class);
    }


    public function user()
    {
        return $this->belongsTo (User::class);
    }


    public function users()
    {
        return $this->belongsToMany (User::class)->withPivot('rating');
    }


    public function scopeLatestWithUser($query)
    {
        $user = auth()->user();

        if($user && $user->adult) {
            return $query->with ('users', 'user')->latest ();
        }

        return $query->with ('users', 'user')->whereAdult(false)->latest ();
    }
}
