<?php
namespace Database\Factories\Helpers;
final class FactoryHelper
{
    public static function getRandomModelId(String $model) {
        $count = $model::query()->count();
        if ($count === 0) {
            $postId = $model::factroy()->create()->id;
        }else{
            $postId = rand(1,$count);
        }
        return $postId;
    }
}
