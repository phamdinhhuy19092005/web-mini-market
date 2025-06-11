<?php 

namespace App\Http\Controllers\Backoffice\Api;

abstract class BaseApiController
{
    public $user;

    public function __construct()
    {
        $this->user = $this->getAuthUser();    
    }

    public function getAuthUser()
    {
        return auth('admins')->user();
    }

    public function responses($responseClass, $resource = null)
    {
        return app($responseClass, ['resource' => $resource]);
    }   
}