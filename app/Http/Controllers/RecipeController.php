<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index()
{
    $recipes = \App\Models\Recipe::all();
    return view('recipes.index', compact('recipes'));
}

    public function create()
    {
        return view('recipes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'instructions' => 'nullable|string',
            'image' => 'nullable|url',
            'origin_country' => 'nullable|string|max:100',
            'cooking_time' => 'nullable|integer',
            'category_id' => 'nullable|integer',
        ]);

        // basic sanitization: strip script tags and any HTML to avoid JS injection
        array_walk($data, function (&$v, $k) {
            if (is_string($v)) {
                $v = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $v);
                $v = strip_tags($v);
            }
        });

        $data['user_id'] = auth()->id() ?? 1;
        $data['category_id'] = $data['category_id'] ?? 1;

        Recipe::create($data);

        return redirect()->route('recipes.index');
    }

    public function show($id)
    {
        $recipe = Recipe::findOrFail($id);
        return view('recipes.show', compact('recipe'));
    }

    public function edit($id)
    {
        $recipe = Recipe::findOrFail($id);
        return view('recipes.edit', compact('recipe'));
    }

    public function update(Request $request, $id)
    {
        $recipe = Recipe::findOrFail($id);
        $data = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'instructions' => 'nullable|string',
            'image' => 'nullable|url',
            'origin_country' => 'nullable|string|max:100',
            'cooking_time' => 'nullable|integer',
            'category_id' => 'nullable|integer',
        ]);

        array_walk($data, function (&$v, $k) {
            if (is_string($v)) {
                $v = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $v);
                $v = strip_tags($v);
            }
        });

        $recipe->update($data);

        return redirect()->route('recipes.index');
    }

    public function destroy($id)
    {
        Recipe::destroy($id);
        return redirect()->route('recipes.index');
    }
}