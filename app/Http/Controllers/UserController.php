<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return UserResource
     */
    public function index(Request $request)
    {
        $page_size = $request->page_size??20;
        $users =  User::query()->paginate($page_size);
        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return UserResource
     */
    public function store(Request $request,UserRepository $userRepository)
    {
        //
        $user = $userRepository->create($request->only([
            'name','email','password'
        ]));
        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return UserResource
     */
    public function show(User $user)
    {
        //
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return UserResource
     */
    public function update(Request $request, $user,UserRepository $userRepository)
    {
        //
        $updated = $userRepository->update($user,$request->only([
            'name','email','password'
        ]));
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return UserResource
     */
    public function destroy($user,UserRepository $userRepository)
    {
        //
        $deleted = $userRepository->forceDelete($user);
        return new JsonResponse([
            'data' => 'success'
        ]);
    }
}
