<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class RecipeApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $recipes = Recipe::with('user')->paginate(12);
        return response()->json($recipes);
    }

    public function show($id): JsonResponse
    {
        $recipe = Recipe::with('user', 'ratings')->findOrFail($id);
        return response()->json($recipe);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'instructions' => 'nullable|string',
            'image' => 'nullable|url',
            'origin_country' => 'nullable|string',
            'cooking_time' => 'nullable|integer',
            'category_id' => 'nullable|integer',
        ]);

        // sanitize inputs to remove script tags / inline JS
        array_walk($data, function (&$v, $k) {
            if (is_string($v)) {
                $v = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $v);
                $v = strip_tags($v);
            }
        });

        $data['user_id'] = $request->user()->id ?? 1;

        $recipe = Recipe::create($data);

        return response()->json($recipe, 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $recipe = Recipe::findOrFail($id);

        $data = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'instructions' => 'nullable|string',
            'image' => 'nullable|url',
            'origin_country' => 'nullable|string',
            'cooking_time' => 'nullable|integer',
            'category_id' => 'nullable|integer',
        ]);

        // sanitize inputs
        array_walk($data, function (&$v, $k) {
            if (is_string($v)) {
                $v = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $v);
                $v = strip_tags($v);
            }
        });

        $recipe->update($data);

        return response()->json($recipe);
    }

    public function destroy($id): JsonResponse
    {
        $recipe = Recipe::findOrFail($id);
        $recipe->delete();
        return response()->json(null, 204);
    }
}
