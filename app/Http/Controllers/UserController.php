<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    /**
     * Display all user's fields.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection(User::all());
    }

    /**
     * Display user's field by ID.
     *
     * @param int $id
     * @return UserResource
     */
    public function show(int $id): UserResource
    {
        return new UserResource(User::findOrFail($id));
    }
}
