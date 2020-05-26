<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\NameSaving;

class Category extends Model
{

    protected $fillable = [
        'name', 'slug',
    ];


    protected $dispatchesEvents = [
        'saving' => NameSaving::class,
    ];


    public function images()
    {
        return $this->hasMany (Image::class);
    }
}
