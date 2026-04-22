<?php

<<<<<<< HEAD
=======
use Illuminate\Http\Request;
>>>>>>> 204b275a6060ddd2972c2a14cbc0149a4c0b2500
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RecipeApiController;
use App\Http\Controllers\Api\CategoryApiController;

<<<<<<< HEAD


Route::get('/recipes', [RecipeApiController::class, 'index'])->name('api.recipes.index');
Route::get('/recipes/{recipe}', [RecipeApiController::class, 'show'])->name('api.recipes.show');

Route::get('/categories', [CategoryApiController::class, 'index'])->name('api.categories.index');
Route::get('/categories/{category}', [CategoryApiController::class, 'show'])->name('api.categories.show');


Route::middleware([\App\Http\Middleware\ApiKeyMiddleware::class])->group(function () {

    Route::post('/recipes', [RecipeApiController::class, 'store'])->name('api.recipes.store');
    Route::put('/recipes/{recipe}', [RecipeApiController::class, 'update'])->name('api.recipes.update');
    Route::patch('/recipes/{recipe}', [RecipeApiController::class, 'update']);
    Route::delete('/recipes/{recipe}', [RecipeApiController::class, 'destroy'])->name('api.recipes.destroy');

    Route::post('/categories', [CategoryApiController::class, 'store'])->name('api.categories.store');
    Route::put('/categories/{category}', [CategoryApiController::class, 'update'])->name('api.categories.update');
    Route::delete('/categories/{category}', [CategoryApiController::class, 'destroy'])->name('api.categories.destroy');
});
=======
// Public (read-only) API endpoints — useful for the frontend refresh button.
Route::middleware(['api'])->group(function () {
    Route::get('recipes', [RecipeApiController::class, 'index'])->name('recipes.index');
    Route::get('recipes/{recipe}', [RecipeApiController::class, 'show'])->name('recipes.show');

    Route::get('categories', [CategoryApiController::class, 'index'])->name('categories.index');
    Route::get('categories/{category}', [CategoryApiController::class, 'show'])->name('categories.show');
});

// Protected API endpoints (modifications require API key)
Route::middleware([
    'api',
    \App\Http\Middleware\ApiKeyMiddleware::class,
])->group(function () {
    Route::post('recipes', [RecipeApiController::class, 'store'])->name('recipes.store');
    Route::put('recipes/{recipe}', [RecipeApiController::class, 'update'])->name('recipes.update');
    Route::patch('recipes/{recipe}', [RecipeApiController::class, 'update']);
    Route::delete('recipes/{recipe}', [RecipeApiController::class, 'destroy'])->name('recipes.destroy');

    Route::post('categories', [CategoryApiController::class, 'store'])->name('categories.store');
    Route::put('categories/{category}', [CategoryApiController::class, 'update'])->name('categories.update');
    Route::patch('categories/{category}', [CategoryApiController::class, 'update']);
    Route::delete('categories/{category}', [CategoryApiController::class, 'destroy'])->name('categories.destroy');
});
>>>>>>> 204b275a6060ddd2972c2a14cbc0149a4c0b2500
