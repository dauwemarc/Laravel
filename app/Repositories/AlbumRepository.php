<?php


namespace App\Repositories;

use App\Models\Album;

class AlbumRepository extends BaseRepository
{

    public function __construct(Album $album)
    {
        $this->model = $album;
    }


    public function create($user, array $inputs)
    {
        $user->albums ()->create($inputs);
    }


    public function getAlbums($user)
    {
        return $user->albums()->get();
    }


    public function getAlbumsWithImages($user)
    {
        return $user->albums()->with('images')->get();
    }
}
