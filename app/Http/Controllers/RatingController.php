<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{
    public function store(Request $request, $id)
{
    // 1. Must be logged in
    if (!auth()->check()) {
        return redirect()->route('login')
            ->with('error', 'Please login to rate recipes.');
    }

    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
    ]);

    // 2. Save rating (example logic)
    Rating::updateOrCreate(
        [
            'user_id' => auth()->id(),
            'recipe_id' => $id,
        ],
        [
            'rating' => $request->rating,
        ]
    );

    return back()->with('success', 'Your rating has been submitted!');
}
}