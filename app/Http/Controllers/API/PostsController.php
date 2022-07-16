<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\AddPostRequest;
use App\Http\Resources\Post\PostResource;
use App\Services\PostsService;
use Illuminate\Http\JsonResponse;

class PostsController extends Controller
{

    protected PostsService $postsService;

    public function __construct(PostsService $postsService)
    {
        $this->postsService = $postsService;
    }

    /**
     * @param AddPostRequest $request
     * @return JsonResponse
     */
    public function addPost(AddPostRequest $request): JsonResponse
    {
        $data = $request->get('data');
        $post = $this->postsService->addPost($data);

        return response()->json(new PostResource($post));
    }
}
