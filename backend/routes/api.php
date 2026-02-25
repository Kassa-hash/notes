<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\EnseignantController;

// Public routes (no auth required for now, auth should be added)
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return response()->json([
        'user'        => $request->user(),
        'roles'       => $request->user()->getRoleNames(),
        'permissions' => $request->user()->getAllPermissions()->pluck('name'),
    ]);
});

// Admin Routes - Protected
Route::middleware(['auth:sanctum'])->group(function () {
    // Create student (admin only)
    Route::post('/admin/students', [AdminController::class, 'createStudent'])
        ->middleware('role:admin');

    // Create teacher (admin only)
    Route::post('/admin/teachers', [AdminController::class, 'createTeacher'])
        ->middleware('role:admin');
});

// Student Routes - Protected
Route::middleware(['auth:sanctum'])->group(function () {
    // Student can see their grades (student only)
    Route::get('/etudiant/grades', [EtudiantController::class, 'getMyNotes'])
        ->middleware('role:etudiant');
});

// Teacher Routes - Protected
Route::middleware(['auth:sanctum'])->group(function () {
    // Teacher can assign grades (teacher only)
    Route::post('/enseignant/assign-grade', [EnseignantController::class, 'assignGrade'])
        ->middleware('role:enseignant');

    // Teacher can see students (teacher only)
    Route::get('/enseignant/students', [EnseignantController::class, 'getStudents'])
        ->middleware('role:enseignant');
});

Route::get('/admin/promotions', [AdminController::class, 'getPromotions']);
Route::get('/admin/classes', [AdminController::class, 'getClasses']);
Route::get('/admin/matieres', [AdminController::class, 'getMatieres']);

