<?php

<<<<<<< HEAD
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RatingController;

=======
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;
>>>>>>> 204b275a6060ddd2972c2a14cbc0149a4c0b2500

Route::get('/', function () {
    return redirect('/recipes');
});

<<<<<<< HEAD
Route::middleware('auth')->group(function () {

    Route::get('/recipes/create', [RecipeController::class, 'create'])
        ->name('recipes.create');

    Route::post('/recipes', [RecipeController::class, 'store'])
        ->name('recipes.store');

    Route::get('/recipes/{recipe}/edit', [RecipeController::class, 'edit'])
        ->name('recipes.edit');

    Route::put('/recipes/{recipe}', [RecipeController::class, 'update'])
        ->name('recipes.update');

    Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])
        ->name('recipes.destroy');

    Route::post('/recipes/{id}/rate', [RatingController::class, 'store'])
        ->name('recipes.rate');
});


Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');

Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');

require __DIR__.'/auth.php';
=======
Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');
Route::get('/recipes/create', [RecipeController::class, 'create'])->name('recipes.create');
Route::post('/recipes', [RecipeController::class, 'store'])->name('recipes.store');

Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');
Route::get('/recipes/{recipe}/edit', [RecipeController::class, 'edit'])->name('recipes.edit');
Route::put('/recipes/{recipe}', [RecipeController::class, 'update'])->name('recipes.update');
Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])->name('recipes.destroy');
>>>>>>> 204b275a6060ddd2972c2a14cbc0149a4c0b2500
