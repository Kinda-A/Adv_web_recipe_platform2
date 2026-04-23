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

// Temporary DB health check (secured by DEBUG_TOKEN in .env)
use Illuminate\Http\Request;
Route::get('/_health/db', function (Request $request) {
    $token = env('DEBUG_TOKEN');
    if (!$token || $request->query('token') !== $token) {
        return response('Not Found', 404);
    }

    try {
        $pdo = new PDO(sprintf('mysql:host=%s;port=%s;dbname=%s', env('DB_HOST'), env('DB_PORT', 3306), env('DB_DATABASE')),
            env('DB_USERNAME'), env('DB_PASSWORD'), [PDO::ATTR_TIMEOUT => 5]);
        $stmt = $pdo->query('SELECT 1');
        $ok = $stmt !== false;
        return response()->json(['ok' => $ok]);
    } catch (Exception $e) {
        return response()->json(['ok' => false, 'error' => $e->getMessage()], 500);
    }
});