<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Resources\ProfileResource;
use App\Services\ProfileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private ProfileService $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * @param $userId
     * @return ProfileResource|array|JsonResponse
     */
    public function show($userId)
    {
        try {
            $profile = $this->profileService->getByUserId($userId);

            return $profile ? ProfileResource::make($profile) : [];
        } catch (\Exception $e) {

            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    public function create(ProfileRequest $request, $userId)
    {
        try {
            $profile = $this->profileService->create($userId, $request->all());

            return ProfileResource::make($profile);
        } catch (\Exception $e) {

            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    public function update(ProfileRequest $request, $userId)
    {
        try {
            $profile = $this->profileService->update($userId, $request->all());

            return ProfileResource::make($profile);
        } catch (\Exception $e) {

            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
