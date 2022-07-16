<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\MakeSubscriptionRequest;
use App\Services\PostsService;
use App\Services\UsersService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{

    protected UsersService $usersService;

    /**
     * @param UsersService $usersService
     */
    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    /**
     * @param MakeSubscriptionRequest $request
     * @return JsonResponse
     */
    public function makeSubscription(MakeSubscriptionRequest $request): JsonResponse
    {
        $data = $request->get('data');

        if ($this->usersService->checkSubscription($data)) {
            return response()->json(['status' => 'error', 'message' => 'Already Subscribed.'], 400);
        }

        $this->usersService->makeSubscription($data);
        return response()->json(['status' => 'success', 'message' => 'Subscribed successfully.']);

    }
}
