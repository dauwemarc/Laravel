<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\NameSaving;

class Album extends Model
{

    protected $fillable = [
        'name', 'slug',
    ];


    protected $dispatchesEvents = [
        'saving' => NameSaving::class,
    ];


    public function images()
    {
        return $this->belongsToMany (Image::class);
    }


    public function user()
    {
        return $this->belongsTo (User::class);
    }
}
