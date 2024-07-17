<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class GeneralJsonException extends Exception
{
    //
    public $code = 422;
    public function report() {

    }

    public function render($request){
        return new JsonResponse([
            'errors' => $this->message
        ],$this->code);
    }
}
