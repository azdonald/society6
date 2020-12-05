<?php


namespace App\Http\Controllers;


use App\Services\CreativeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreativeController extends Controller
{
    private $creativeService;

    public function __construct(CreativeService $creativeService)
    {
        $this->creativeService = $creativeService;
    }

    public function create(Request $request): JsonResponse
    {
        $creative = $this->creativeService->add($request->all());
        return response()->json($creative, 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $creative = $this->creativeService->update($id, $request->all());
        return response()->json($creative, 200);
    }



    public function getAll(Request $request): JsonResponse
    {
        $creatives = $this->creativeService->getAllCreatives();
        return response()->json($creatives, 200);
    }

    public function getCreative(Request $request, $id): JsonResponse
    {
        $creative = $this->creativeService->getCreative($id);
        return response()->json($creative, 200);
    }


}
