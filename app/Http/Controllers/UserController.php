<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Models\User;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{

    protected $repository;


    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;

        $this->middleware('ajax')->only('destroy');
    }


    public function index()
    {
        $users = $this->repository->getAllWithPhotosCount();

        return view ('users.index', compact('users'));
    }


    public function edit(User $user)
    {
        return view ('users.edit', compact ('user'));
    }


    public function update(UserRequest $request, User $user)
    {
        $this->repository->update ($user, $request);

        return redirect ()->route('user.index')->with ('ok', __ ("L'utilisateur a bien été modifié"));
    }

  
    public function destroy(User $user)
    {
        $user->delete ();

        return response ()->json ();
    }
}
