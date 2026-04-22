<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\Request;

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

        $data['user_id'] = 1;
        $data['category_id'] = $data['category_id'] ?? 1;

        $recipe = Recipe::create($data);

        return response()->json($recipe, 201);
    }

    public function update(Request $request, $id)
    {
        $recipe = Recipe::findOrFail($id);
        $recipe->update($request->all());

        return response()->json($recipe);
    }

    public function destroy($id)
    {
        Recipe::findOrFail($id)->delete();

        return response()->json(['message' => 'Deleted']);
    }
}