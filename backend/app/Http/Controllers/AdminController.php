<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Etudiant;
use App\Models\Enseignant;
use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\Classe;
use App\Models\Matiere;

class AdminController extends Controller
{
    public function createStudent(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'nom' => 'required|string|max:255',
            'dtn' => 'required|date',
            'idpromotion' => 'required|integer|exists:promotions,id',
            'idclasse' => 'required|integer|exists:classes,id',
        ]);

        // Create User
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        $user->assignRole('etudiant');

        // Create Student with user_id
        $etudiant = Etudiant::create([
            'nom' => $validated['nom'],
            'dtn' => $validated['dtn'],
            'idpromotion' => $validated['idpromotion'],
            'idclasse' => $validated['idclasse'],
            'user_id' => $user->id,
        ]);

        return response()->json([
            'message' => 'Étudiant créé avec succès',
            'user' => $user,
            'etudiant' => $etudiant,
        ], 201);
    }

    public function createTeacher(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'nom' => 'required|string|max:255',
            'dateentree' => 'required|date',
            'matieres' => 'array',
            'matieres.*' => 'integer|exists:matieres,id',
        ]);

        // Create User
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        $user->assignRole('enseignant');

        // Create Teacher with user_id
        $enseignant = Enseignant::create([
            'nom' => $validated['nom'],
            'dateentree' => $validated['dateentree'],
            'user_id' => $user->id,
        ]);

        // Attach subjects if provided
        if (!empty($validated['matieres'])) {
            $enseignant->matieres()->attach($validated['matieres']);
        }

        return response()->json([
            'message' => 'Enseignant créé avec succès',
            'user' => $user,
            'enseignant' => $enseignant,
        ], 201);
    }

    public function getPromotions()
    {
        return Promotion::all();
    }

    public function getClasses()
    {
        return Classe::all();
    }

    public function getMatieres()
    {
        return Matiere::all();
    }
}
