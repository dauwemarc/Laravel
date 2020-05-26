<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Http\Requests\AlbumRequest;
use App\Repositories\AlbumRepository;
use Illuminate\Http\Request;

class AlbumController extends Controller
{

    protected $repository;


    public function __construct(AlbumRepository $repository)
    {
        $this->repository = $repository;

        $this->middleware('ajax')->only('destroy');
    }


    public function index(Request $request)
    {
        $userAlbums = $this->repository->getAlbums ($request->user ());

        return view ('albums.index', compact('userAlbums'));
    }


    public function create()
    {
        return view ('albums.create');
    }


    public function store(AlbumRequest $request)
    {
        $this->repository->create ($request->user(), $request->all ());

        return redirect ()->route('album.index')->with ('ok', __ ("L'album a bien été enregistré"));
    }


    public function edit(Album $album)
    {
        return view ('albums.edit', compact ('album'));
    }


    public function update(AlbumRequest $request, Album $album)
    {
        $this->authorize('manage', $album);

        $album->update ($request->all ());

        return redirect ()->route('album.index')->with ('ok', __ ("L'album a bien été modifié"));
    }


    public function destroy(Album $album)
    {
        $this->authorize('manage', $album);

        $album->delete ();

        return response ()->json ();
    }
}
