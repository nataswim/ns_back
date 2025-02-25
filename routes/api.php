<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UploadController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\ExerciseController;
use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\WorkoutController;
use App\Http\Controllers\Api\WorkoutExerciseController;
use App\Http\Controllers\Api\MylistController;
use App\Http\Controllers\Api\SwimSetController;
use App\Http\Controllers\Api\MylistItemController;
use App\Http\Controllers\Api\PlanWorkoutController;
use App\Http\Controllers\Api\WorkoutSwimSetController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Ici sont enregistrées les routes API de votre application. Ces routes sont
| chargées par le RouteServiceProvider dans un groupe de middleware "api".
| Utilisez ce fichier pour définir vos routes d'API.
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ************************************************************************
// Routes pour les rôles (Roles)
// ************************************************************************

Route::apiResource('roles', RoleController::class);
Route::get('roles/{role}/users', [UserController::class, 'getUsersByRole']);

// ************************************************************************
// Routes pour les utilisateurs (Users)
// ************************************************************************

Route::apiResource('users', UserController::class);

// ************************************************************************
// Routes pour les fichiers uploadés (Uploads)
// ************************************************************************

Route::apiResource('uploads', UploadController::class);
Route::get('users/{user}/uploads', [UploadController::class, 'getUserUploads']);

// ************************************************************************
// Routes pour les pages (Pages)
// ************************************************************************

Route::apiResource('pages', PageController::class);

// ************************************************************************
// Routes pour les exercices (Exercises)
// ************************************************************************

Route::apiResource('exercises', ExerciseController::class);

// ************************************************************************
// Routes pour les plans (Plans)
// ************************************************************************

Route::apiResource('plans', PlanController::class);
Route::get('plans/{plan}/workouts', [PlanController::class, 'getWorkouts']); // Correction : utilisation de PlanController
Route::post('plans/{plan}/workouts/{workout}', [PlanController::class, 'addWorkout']); // Correction : utilisation de PlanController
Route::delete('plans/{plan}/workouts/{workout}', [PlanController::class, 'removeWorkout']); // Correction : utilisation de PlanController

Route::get('/plans/{plan}/workouts/{workout}', [PlanWorkoutController::class, 'show']); // Correction : utilisation de PlanWorkoutController

// ************************************************************************
// Routes pour les séances d'entraînement (Workouts)
// ************************************************************************

Route::apiResource('workouts', WorkoutController::class);
Route::get('workouts/{workout}/exercises', [WorkoutController::class, 'getExercises']); // Correction : utilisation de WorkoutController
Route::get('/workouts/{workout}/exercises/{exercise}', [WorkoutExerciseController::class, 'show']); // Correction : utilisation de WorkoutExerciseController
Route::post('workouts/{workout}/exercises/{exercise}', [WorkoutController::class, 'addExercise']); // Correction : utilisation de WorkoutController
Route::delete('workouts/{workout}/exercises/{exercise}', [WorkoutController::class, 'removeExercise']); // Correction : utilisation de WorkoutController
Route::get('workouts/{workout}/swim-sets', [WorkoutController::class, 'getSwimSets']); // Correction : utilisation de WorkoutController
Route::post('workouts/{workout}/swim-sets/{swimSet}', [WorkoutController::class, 'addSwimSet']); // Correction : utilisation de WorkoutController
Route::delete('workouts/{workout}/swim-sets/{swimSet}', [WorkoutController::class, 'removeSwimSet']); // Correction : utilisation de WorkoutController
Route::get('/workouts/{workout}/swim-sets', [WorkoutSwimSetController::class, 'index']); // Correction : utilisation de WorkoutSwimSetController
// ************************************************************************
// Routes pour les séries de natation (Swim Sets)
// ************************************************************************

Route::apiResource('swim-sets', SwimSetController::class);

// ************************************************************************
// Routes pour les listes personnelles (Mylists)
// ************************************************************************

Route::apiResource('mylists', MylistController::class);
Route::get('mylist/{mylist}/items', [MylistItemController::class, 'index']);
Route::post('mylist/{mylist}/items', [MylistItemController::class, 'store']);
Route::delete('mylist/{mylist}/items/{item}', [MylistItemController::class, 'destroy']);