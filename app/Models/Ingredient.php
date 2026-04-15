<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Related model
use App\Models\Recipe;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipe_id',
        'name',
        'quantity',
    ];

    /**
     * Relationships
     */

    // ingredient belongs to a recipe
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}