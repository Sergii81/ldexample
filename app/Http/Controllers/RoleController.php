<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Http\Resources\RoleResource;
use App\Services\RoleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class RoleController extends Controller
{
    /**
     * @var RoleService
     */
    private RoleService $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index()
    {
        $roles = $this->roleService->getAll();

        if (empty($roles)) {

            return response()->json(['message' => 'Roles not found'], 404);
        }

        return RoleResource::collection($roles);
    }

    /**
     * @param RoleRequest $request
     * @return RoleResource|JsonResponse
     */
    public function create(RoleRequest $request)
    {
        try {
            $role = $this->roleService->create($request->all());

            return RoleResource::make($role);
        } catch (\Exception $e) {

            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    /**
     * @param RoleRequest $request
     * @param $id
     * @return RoleResource|JsonResponse
     */
    public function update(RoleRequest $request, $id)
    {
        try {
            $role = $this->roleService->update($id, $request->all());

            return RoleResource::make($role);
        } catch (\Exception $e) {

            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    /**
     * @param $roleId
     * @param $userId
     * @return JsonResponse
     */
    public function addToUser($roleId, $userId): JsonResponse
    {
        try {
            $this->roleService->addToUser($roleId, $userId);

            return response()->json(['message' => 'Role added successfully']);
        } catch (\Exception $e) {

            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
