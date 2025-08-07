<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\StoreOrderResponseContract;
use App\Http\Responses\BaseViewResponses;

class StoreOrderResponses extends BaseViewResponses implements StoreOrderResponseContract
{
    public function toResponse($request)
    {
        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $this->resource->id ?? null,
            ],
        ], 200);
    }
}
