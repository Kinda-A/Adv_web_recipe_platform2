<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RatingController;

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect('/recipes');
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (protected)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Create recipe
    Route::get('/recipes/create', [RecipeController::class, 'create'])
        ->name('recipes.create');

    Route::post('/recipes', [RecipeController::class, 'store'])
        ->name('recipes.store');

    // Edit recipe
    Route::get('/recipes/{recipe}/edit', [RecipeController::class, 'edit'])
        ->name('recipes.edit');

    Route::put('/recipes/{recipe}', [RecipeController::class, 'update'])
        ->name('recipes.update');

    // Delete recipe
    Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])
        ->name('recipes.destroy');

    // Rate recipe
    Route::post('/recipes/{id}/rate', [RatingController::class, 'store'])
        ->name('recipes.rate');
    Route::get('/dashboard', function () {
    return redirect('/recipes');
})->middleware(['auth'])->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

// list recipes
Route::get('/recipes', [RecipeController::class, 'index'])
    ->name('recipes.index');

// show single recipe
Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])
    ->name('recipes.show');

require __DIR__.'/auth.php';