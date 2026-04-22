<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RecipeApiController;
use App\Http\Controllers\Api\CategoryApiController;

/*
|--------------------------------------------------------------------------
| PUBLIC API
|--------------------------------------------------------------------------
*/

Route::get('/recipes', [RecipeApiController::class, 'index'])->name('api.recipes.index');
Route::get('/recipes/{recipe}', [RecipeApiController::class, 'show'])->name('api.recipes.show');

Route::get('/categories', [CategoryApiController::class, 'index'])->name('api.categories.index');
Route::get('/categories/{category}', [CategoryApiController::class, 'show'])->name('api.categories.show');

/*
|--------------------------------------------------------------------------
| PROTECTED API
|--------------------------------------------------------------------------
*/

Route::middleware([\App\Http\Middleware\ApiKeyMiddleware::class])->group(function () {

    Route::post('/recipes', [RecipeApiController::class, 'store'])->name('api.recipes.store');
    Route::put('/recipes/{recipe}', [RecipeApiController::class, 'update'])->name('api.recipes.update');
    Route::patch('/recipes/{recipe}', [RecipeApiController::class, 'update']);
    Route::delete('/recipes/{recipe}', [RecipeApiController::class, 'destroy'])->name('api.recipes.destroy');

    Route::post('/categories', [CategoryApiController::class, 'store'])->name('api.categories.store');
    Route::put('/categories/{category}', [CategoryApiController::class, 'update'])->name('api.categories.update');
    Route::delete('/categories/{category}', [CategoryApiController::class, 'destroy'])->name('api.categories.destroy');
});