<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class ImageRated extends Notification
{

    protected $image;


    protected $rate;


    protected $user_id;


    public function __construct($image, $rate, $user_id)
    {
        $this->image = $image;
        $this->rate = $rate;
        $this->user_id = $user_id;
    }


    public function via()
    {
        return ['database'];
    }

    public function toArray()
    {
        return [
            'image' => $this->image->name,
            'image_id' => (integer)$this->image->id,
            'rate' => (integer)$this->rate,
            'user' => (integer)$this->user_id
        ];
    }
}
