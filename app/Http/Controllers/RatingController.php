<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::with(['user', 'ratings'])->get();
        return view('recipes.index', compact('recipes'));
    }

    public function create()
    {
        return view('recipes.create');
    }

    public function store(Request $request)
    {
        Recipe::create([
            'user_id' => 1,
            'category_id' => 1,
            'title' => $request->title,
            'description' => $request->description,
            'instructions' => $request->instructions,
            'image' => $request->image,
            'origin_country' => $request->origin_country,
        ]);

        return redirect('/')->with('success', 'Recipe added successfully!');
    }
}