<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Routing\Controller;

abstract class BaseController extends Controller
{
    public function responses($responseClass, $resource = null)
    {
        return app($responseClass, ['resource' => $resource]);
    }
}
