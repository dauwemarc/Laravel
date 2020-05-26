<?php

namespace App\Policies;

use App\Models\ { User, Album };
use Illuminate\Auth\Access\HandlesAuthorization;

class AlbumPolicy
{
    use HandlesAuthorization;


    public function before(User $user)
    {
        if ($user->admin) {
            return true;
        }
    }


    public function manage(User $user, Album $album)
    {
        return $user->id === $album->user_id;
    }
}
