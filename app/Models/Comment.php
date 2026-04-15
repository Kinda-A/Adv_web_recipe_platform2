<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Related models
use App\Models\User;
use App\Models\Recipe;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'recipe_id',
        'comment',
    ];

    /**
     * Relationships
     */

    // comment belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // comment belongs to recipe
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
