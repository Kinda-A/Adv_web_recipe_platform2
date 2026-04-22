<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'title',
        'description',
        'instructions',
        'image',
        'origin_country',
        'cooking_time',
        'user_id',
        'category_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
    public function getAverageRatingAttribute()
{
    return round($this->ratings()->avg('rating'), 1);
}
}