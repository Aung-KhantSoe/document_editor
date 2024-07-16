<?php
    
namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    public function create($attributes){
        return DB::transaction(function () use ($attributes) {
            $user = User::query()->create([
                'name' => data_get($attributes,'name'),
                'email' => data_get($attributes,'email'),
                'password' => Hash::make(data_get($attributes,'password')),
            ]);
            
            return $user;
        });
    }
    public function update($user,$attributes){
        return DB::transaction(function () use ($user,$attributes){
            $updated =  $user->update([
                'name' => data_get($attributes,'name',$user->name),
                'email' => data_get($attributes,'email',$user->name),
                'password' => Hash::make(data_get($attributes,'password'))??$user->password,
            ]);
            if(!$updated){
                throw new \Exception("Failed to update user", 1);
                
            }
            
            return $user;
        });
        
    }
    public function forceDelete($user){
        return DB::transaction(function () use ($user) {
            $deleted = $user->forceDelete();
            if(!$deleted){
                throw new \Exception("Failed to delete user", 1); 
            }
            return $deleted;
        });

    }
}

?>