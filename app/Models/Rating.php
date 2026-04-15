<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Related models
use App\Models\User;
use App\Models\Recipe;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'recipe_id',
        'rating',
    ];

    /**
     * Relationships
     */

    // rating belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // rating belongs to recipe
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}