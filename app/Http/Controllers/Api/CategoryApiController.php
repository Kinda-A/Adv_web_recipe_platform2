<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CategoryApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $categories = Category::withCount('recipes')->get();
        return response()->json($categories);
    }

    public function show($id): JsonResponse
    {
        $category = Category::with('recipes')->findOrFail($id);
        return response()->json($category);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // sanitize
        if (isset($data['name']) && is_string($data['name'])) {
            $data['name'] = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $data['name']);
            $data['name'] = strip_tags($data['name']);
        }

        $category = Category::create($data);

        return response()->json($category, 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $category = Category::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        if (isset($data['name']) && is_string($data['name'])) {
            $data['name'] = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $data['name']);
            $data['name'] = strip_tags($data['name']);
        }

        $category->update($data);

        return response()->json($category);
    }

    public function destroy($id): JsonResponse
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json(null, 204);
    }
}
