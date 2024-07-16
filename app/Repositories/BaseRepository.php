<?php
    
namespace App\Repositories;
abstract class BaseRepository 
{
    abstract public function create($attributes);
    abstract public function update($model,$attributes);
    abstract public function forceDelete($model);
}

?>