<?php 

namespace App\Http\Controllers\Backoffice\Api;

abstract class BaseApiController
{
    public function responses($responseClass, $resource = null)
    {
        return app($responseClass, ['resource' => $resource]);
    }   
}