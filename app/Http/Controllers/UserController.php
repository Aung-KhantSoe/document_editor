<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
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
    public function index()
    {
        $users =  User::query()->get();
        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return UserResource
     */
    public function store(Request $request)
    {
        //
        $user = User::query()->create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
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
    public function update(Request $request, $user)
    {
        //
        $updated = $user->update([
            'name'=>$request->name??$user->name,
            'email'=>$request->email??$user->name,
            'password'=>Hash::make($request->password??$user->name),
        ]);
        if(!$updated){
            return new JsonResponse([
                'errors' => [
                    'Failed to update comment'
                ]
            ]);
        }
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return UserResource
     */
    public function destroy($user)
    {
        //
        $deleted = $user->forceDelete();
        if(!$deleted){
            return new JsonResponse([
                'errors' => [
                    'Failed to delete user'
                ]
            ]);
        }
        return new JsonResponse([
            'data' => 'success'
        ]);
    }
}
