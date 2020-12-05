<?php


namespace App\Http\Controllers;


use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    private $userService;

    /**
     * UserController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \App\Exceptions\InvalidRequestException
     */
    public function register(Request $request): JsonResponse
    {
        $user = $this->userService->createUser($request->all());
        return response()->json($user, 201);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $user = $this->userService->login($request->all());
         return response()->json($user, 201);

    }

}
