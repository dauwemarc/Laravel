<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class NotificationRepository
{
    
    public function deleteDuplicate($user, $image)
    {
        DB::table('notifications')
            ->whereNotifiableId($image->user->id)
            ->whereNull('read_at')
            ->where('data->image_id', $image->id)
            ->where('data->user', $user->id)
            ->delete();
    }
}
