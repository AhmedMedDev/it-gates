<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Todo\StoreRequest;
use App\Http\Requests\Todo\UpdateRequest;
use App\Services\TodoService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use App\Models\Todo;

class TodosController extends Controller
{
    private TodoService $TodoService;

    public function __construct(TodoService $TodoService)
    {
        $this->TodoService = $TodoService;
        $this->middleware('auth:api');
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'payload' => $this->TodoService->getTodos(),
        ]);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        
        $payload = $this->TodoService->store($data);

        return response()->json([
            'message' => __('messages.created successfully'),
            'payload' => $payload,
        ], Response::HTTP_CREATED);
    }

    public function update(UpdateRequest $request, Todo $Todo): JsonResponse
    {
        $request = $request->validated();

        $this->TodoService->update($request, $Todo);

        return response()->json([
            'message' => __('messages.updated successfully'),
        ]);
    }
    
    public function destroy(Todo $Todo): JsonResponse
    {
        $this->TodoService->delete($Todo);

        return response()->json([
            'message' => __('messages.deleted successfully'),
        ]);
    }
}
