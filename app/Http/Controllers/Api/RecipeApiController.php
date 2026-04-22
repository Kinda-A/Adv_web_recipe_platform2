<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\Request;
<<<<<<< HEAD

class RecipeApiController extends Controller
{
    public function index()
    {
        return response()->json(
            Recipe::with(['user'])->paginate(12)
        );
    }

    public function show($id)
    {
        return response()->json(
            Recipe::with(['user', 'ratings'])->findOrFail($id)
        );
    }

    public function store(Request $request)
=======
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
>>>>>>> 204b275a6060ddd2972c2a14cbc0149a4c0b2500
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

<<<<<<< HEAD
        $data['user_id'] = 1;
        $data['category_id'] = $data['category_id'] ?? 1;
=======
        // sanitize inputs to remove script tags / inline JS
        array_walk($data, function (&$v, $k) {
            if (is_string($v)) {
                $v = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $v);
                $v = strip_tags($v);
            }
        });

        $data['user_id'] = $request->user()->id ?? 1;
>>>>>>> 204b275a6060ddd2972c2a14cbc0149a4c0b2500

        $recipe = Recipe::create($data);

        return response()->json($recipe, 201);
    }

<<<<<<< HEAD
    public function update(Request $request, $id)
    {
        $recipe = Recipe::findOrFail($id);
        $recipe->update($request->all());
=======
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
>>>>>>> 204b275a6060ddd2972c2a14cbc0149a4c0b2500

        return response()->json($recipe);
    }

<<<<<<< HEAD
    public function destroy($id)
    {
        Recipe::findOrFail($id)->delete();

        return response()->json(['message' => 'Deleted']);
    }
}
=======
    public function destroy($id): JsonResponse
    {
        $recipe = Recipe::findOrFail($id);
        $recipe->delete();
        return response()->json(null, 204);
    }
}
>>>>>>> 204b275a6060ddd2972c2a14cbc0149a4c0b2500
