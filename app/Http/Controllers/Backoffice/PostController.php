<?php

namespace App\Http\Controllers\Backoffice;

use App\Contracts\Responses\Backoffice\StorePostResponseContract;
use App\Contracts\Responses\Backoffice\UpdatePostResponseContract;
use App\Http\Requests\Interfaces\StorePostRequestInterface;
use App\Http\Requests\Interfaces\UpdatePostRequestInterface;
use App\Models\PostCategory;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends BaseController
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(Request $request)
    {
        return view('backoffice.pages.posts.index');
    }

    public function create()
    {
        $postCategories = PostCategory::all();
        return view('backoffice.pages.posts.create', compact('postCategories'));
    }

    public function store(StorePostRequestInterface $request)
    {
        $post = $this->postService->create($request->validated());
        return $this->responses(StorePostResponseContract::class, $post);
    }

    public function show($id)
    {
        $postCategories = PostCategory::all();
        $post = $this->postService->show($id);
        return view('backoffice.pages.posts.edit', compact('postCategories','post'));
    }

    public function edit($id)
    {
        $postCategories = PostCategory::all();
        $post = $this->postService->show($id);
        return view('backoffice.pages.posts.edit', compact('postCategories','post'));
    }

    public function update(UpdatePostRequestInterface $request, $id)
    {
        $file = $request->imageFile();
        $post = $this->postService->update($id, $request->validated(), $file);
        return $this->responses(UpdatePostResponseContract::class, $post);
    }

    public function destroy($id)
    {
        $this->postService->delete($id);
        return redirect()->route('bo.web.posts.index');
    }
    
}
