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
| 🇬🇧 Here are the API routes of your application. These routes are
| loaded by the RouteServiceProvider within a "api" middleware group.
| Use this file to define your API routes.
|
| 🇫🇷 Voici les routes API de votre application. Ces routes sont
| chargées par le RouteServiceProvider dans un groupe de middleware "api".
| Utilisez ce fichier pour définir vos routes d'API.
|
*/

// ************************************************************************
// 🇬🇧 User Authentication Route
// 🇫🇷 Route pour l'authentification des utilisateurs
// ************************************************************************
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ************************************************************************
// 🇬🇧 Routes for Roles (Rôles)
// 🇫🇷 Routes pour les rôles (Roles)
// ************************************************************************
Route::apiResource('roles', RoleController::class);
Route::get('roles/{role}/users', [UserController::class, 'getUsersByRole']);

// ************************************************************************
// 🇬🇧 Routes for Users (Utilisateurs)
// 🇫🇷 Routes pour les utilisateurs (Users)
// ************************************************************************
Route::apiResource('users', UserController::class);

// ************************************************************************
// 🇬🇧 Routes for File Uploads (Fichiers Uploadés)
// 🇫🇷 Routes pour les fichiers uploadés (Uploads)
// ************************************************************************
Route::apiResource('uploads', UploadController::class);
Route::get('users/{user}/uploads', [UploadController::class, 'getUserUploads']);

// ************************************************************************
// 🇬🇧 Routes for Pages (Pages)
// 🇫🇷 Routes pour les pages (Pages)
// ************************************************************************
Route::apiResource('pages', PageController::class);

// ************************************************************************
// 🇬🇧 Routes for Exercises (Exercices)
// 🇫🇷 Routes pour les exercices (Exercises)
// ************************************************************************
Route::apiResource('exercises', ExerciseController::class);

// ************************************************************************
// 🇬🇧 Routes for Plans (Plans)
// 🇫🇷 Routes pour les plans (Plans)
// ************************************************************************
Route::apiResource('plans', PlanController::class);
Route::get('plans/{plan}/workouts', [PlanController::class, 'getWorkouts']);
Route::post('plans/{plan}/workouts/{workout}', [PlanController::class, 'addWorkout']);
Route::delete('plans/{plan}/workouts/{workout}', [PlanController::class, 'removeWorkout']);
Route::get('/plans/{plan}/workouts/{workout}', [PlanWorkoutController::class, 'show']);

// ************************************************************************
// 🇬🇧 Routes for Workouts (Séances d'entraînement)
// 🇫🇷 Routes pour les séances d'entraînement (Workouts)
// ************************************************************************
Route::apiResource('workouts', WorkoutController::class);
Route::get('workouts/{workout}/exercises', [WorkoutController::class, 'getExercises']);
Route::get('/workouts/{workout}/exercises/{exercise}', [WorkoutExerciseController::class, 'show']);
Route::post('workouts/{workout}/exercises/{exercise}', [WorkoutController::class, 'addExercise']);
Route::delete('workouts/{workout}/exercises/{exercise}', [WorkoutController::class, 'removeExercise']);
Route::get('workouts/{workout}/swim-sets', [WorkoutController::class, 'getSwimSets']);
Route::post('workouts/{workout}/swim-sets/{swimSet}', [WorkoutController::class, 'addSwimSet']);
Route::delete('workouts/{workout}/swim-sets/{swimSet}', [WorkoutController::class, 'removeSwimSet']);
Route::get('/workouts/{workout}/swim-sets', [WorkoutSwimSetController::class, 'index']);

// ************************************************************************
// 🇬🇧 Routes for Swim Sets (Séries de natation)
// 🇫🇷 Routes pour les séries de natation (Swim Sets)
// ************************************************************************
Route::apiResource('swim-sets', SwimSetController::class);

// ************************************************************************
// 🇬🇧 Routes for Personal Lists (Listes personnelles)
// 🇫🇷 Routes pour les listes personnelles (Mylists)
// ************************************************************************
Route::apiResource('mylists', MylistController::class);
Route::get('mylist/{mylist}/items', [MylistItemController::class, 'index']);
Route::post('mylist/{mylist}/items', [MylistItemController::class, 'store']);
Route::delete('mylist/{mylist}/items/{item}', [MylistItemController::class, 'destroy']);
