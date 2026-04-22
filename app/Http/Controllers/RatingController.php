<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD
use App\Models\Rating;

class RatingController extends Controller
{
    public function store(Request $request, $recipeId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Rating::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'recipe_id' => $recipeId,
            ],
            [
                'rating' => $request->rating,
            ]
        );

        return back()->with('success', 'Rating saved!');
=======
use App\Models\Recipe;

class RatingController extends Controller
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
>>>>>>> 204b275a6060ddd2972c2a14cbc0149a4c0b2500
    }
}