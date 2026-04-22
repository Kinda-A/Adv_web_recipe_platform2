<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    }
}