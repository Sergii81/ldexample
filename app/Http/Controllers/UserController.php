<?php

namespace App\Http\Controllers;

use App\Exceptions\UserNotFoundException;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    /**
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function index()
    {
        $users = $this->userService->getAll();

        if (empty($users)) {

            return response()->json(['message' => 'Users not found'], 404);
        }

        return UserResource::collection($users);
    }

    /**
     * @param $id
     * @return UserResource|JsonResponse
     */
    public function show($id)
    {
        try {
            $user = $this->userService->get($id);

            return UserResource::make($user);
        } catch (\Exception $e) {

            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    /**
     * @param UserRequest $request
     * @return UserResource|JsonResponse
     */
    public function create(UserRequest $request)
    {
        try {
            $user = $this->userService->create($request->all());

            return UserResource::make($user);
        } catch (\Exception $e) {

            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    /**
     * @param UserRequest $request
     * @param $id
     * @return UserResource|JsonResponse
     */
    public function update(UserRequest $request, $id)
    {
        try {
            $user = $this->userService->update($id, $request->all());

            return UserResource::make($user);
        } catch (\Exception $e) {

            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        try {
            $this->userService->delete($id);

            return response()->json(['message' => 'User deleted successful']);
        } catch (\Exception $e) {

            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
