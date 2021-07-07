<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    /**
     * Display all users.
     *
     * @responseFile responses/user/users-list.json
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection(User::all());
    }

    /**
     * Display user's fields by ID.
     *
     * @param int $id
     * @responseFile responses/user/user-data.json
     *
     * @return UserResource
     */
    public function show(int $id): UserResource
    {
        return new UserResource(User::findOrFail($id));
    }
}
