<?php

namespace App\Policies;

use App\Models\ { User, Image };
use Illuminate\Auth\Access\HandlesAuthorization;

class ImagePolicy
{
    use HandlesAuthorization;


    public function before(User $user)
    {
        if ($user->admin) {
            return true;
        }
    }


    public function manage(User $user, Image $image)
    {
        return $user->id === $image->user_id;
    }
}
