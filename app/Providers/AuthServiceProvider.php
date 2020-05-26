<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Policies\{
    AlbumPolicy, ImagePolicy, UserPolicy
};
use App\Models\ { Image, User, Album };

class AuthServiceProvider extends ServiceProvider
{
    
    protected $policies = [
        Album::class => AlbumPolicy::class,
        Image::class => ImagePolicy::class,
        User::class => UserPolicy::class,
    ];


    public function boot()
    {
        $this->registerPolicies();
    }
}
