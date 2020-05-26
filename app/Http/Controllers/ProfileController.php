<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\ImageRepository;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('ajax')->only('destroy');
    }


    public function edit(User $user)
    {
        $this->authorize ('manage', $user);

        return view ('profiles.edit', compact ('user'));
    }


    public function update(Request $request, User $user)
    {
        $this->authorize ('manage', $user);

        $request->validate ([
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'pagination' => 'required',
        ]);

        $user->update ([
            'email' => $request->email,
            'settings' => json_encode ([
                'pagination' => (integer)$request->pagination,
                'adult' => $request->filled('adult'),
            ]),
        ]);

        return back ()->with ('ok', __ ('Le profil a bien été mis à jour'));
    }


    public function destroy(User $user)
    {
        $this->authorize ('manage', $user);

        $user->delete();

        return response ()->json ();
    }

    
    public function show(ImageRepository $imageRepository, User $user)
    {
        $this->authorize ('manage', $user);

        $images = $imageRepository->getImagesForUser ($user->id);

        return view ('profiles.data', compact ('user', 'images'));
    }
}
