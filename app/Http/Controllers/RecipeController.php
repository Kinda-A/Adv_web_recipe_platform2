<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $query = Recipe::with('user');

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $recipes = $query->with(['user', 'ratings'])->get();

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

        // SAFE DEFAULTS
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

        $recipe->update($data);

        return redirect()->route('recipes.index');
    }

    public function destroy($id)
    {
        Recipe::destroy($id);
        return redirect()->route('recipes.index');
    }
}