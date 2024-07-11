<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize("viewAny", User::class);
        return UserResource::collection(
            User::all()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $this->authorize("create", User::class);

        $user = User::create($request->validated());

        if ($request->role) {
            $user->assignRole($request->role);
        }

        return UserResource::make($user);
    }
    
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $this->authorize("view", $user);

        return UserResource::make($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $this->authorize("update", $user);

        $user->update($request->validated());

        if ($user->role)
        {
            $user->assignRole($user->role);
        }
        return UserResource::make(
            $user->refresh()
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize("delete", $user);

        return $user->delete();
    }
}
