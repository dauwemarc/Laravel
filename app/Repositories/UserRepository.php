<?php


namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserRepository extends BaseRepository
{

    public function __construct(User $user)
    {
        $this->model = $user;
    }


    public function update(User $user, Request $request)
    {
        if($user->hasVerifiedEmail() && !$request->verified) {
            $request->merge(['email_verified_at' => null]);
        }

        if(!$user->hasVerifiedEmail() && $request->verified) {
            $request->merge(['email_verified_at' => new Carbon]);
        }

        $user->adult = $request->adult;
        $user->update ($request->all());
    }

    
    public function getAllWithPhotosCount()
    {
        return User::withCount('images')->oldest('name')->get();
    }

}
