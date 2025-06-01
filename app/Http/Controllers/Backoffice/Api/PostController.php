<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListPostResponseContract;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends BaseApiController
{
    public function __construct(protected PostService $postService)
    {
    }

    public function index(Request $request)
    {
        $posts = $this->postService->searchByAdmin($request->all());
        return $this->responses(ListPostResponseContract::class, $posts);
    }
}
