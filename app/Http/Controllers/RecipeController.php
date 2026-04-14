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
    Recipe::create([
        'title' => $request->title,
        'description' => $request->description,
        'instructions' => $request->instructions,
        'image' => $request->image,
        'origin_country' => $request->origin_country,
        'cooking_time' => $request->cooking_time,
        'user_id' => 1,
        'category_id' => 1
    ]);

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

        $recipe->update([
            'title' => $request->title,
            'description' => $request->description,
            'instructions' => $request->instructions,
            'image' => $request->image,
            'origin_country' => $request->origin_country,
            'cooking_time' => $request->cooking_time,
        ]);

        return redirect()->route('recipes.index');
    }

    public function destroy($id)
    {
        Recipe::destroy($id);
        return redirect()->route('recipes.index');
    }
}