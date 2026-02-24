<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Etudiant;
use App\Models\Enseignant;
use App\Models\Matiere;
use Illuminate\Http\Request;

class EnseignantController extends Controller
{
    public function assignGrade(Request $request)
    {
        $user = $request->user();

        if (!$user || !$user->hasRole('enseignant')) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        $validated = $request->validate([
            'idEtudiant' => 'required|integer|exists:etudiants,id',
            'idMatiere' => 'required|integer|exists:matieres,id',
            'note' => 'required|numeric|min:0|max:20',
        ]);

        // Check if teacher teaches this subject
        $enseignant = Enseignant::where('user_id', $user->id)->first();

        if (!$enseignant) {
            return response()->json(['message' => 'Enseignant non trouvé'], 404);
        }

        $matiere = $enseignant->matieres()->find($validated['idMatiere']);

        if (!$matiere) {
            return response()->json([
                'message' => 'Vous n\'êtes pas autorisé à attribuer des notes dans cette matière',
            ], 403);
        }

        // Create or update the grade
        $note = Note::updateOrCreate(
            [
                'idEtudiant' => $validated['idEtudiant'],
                'idMatiere' => $validated['idMatiere'],
            ],
            ['note' => $validated['note']]
        );

        return response()->json([
            'message' => 'Note attribuée avec succès',
            'note' => $note->load('etudiant', 'matiere'),
        ], 201);
    }

    public function getStudents(Request $request)
    {
        $user = $request->user();

        if (!$user || !$user->hasRole('enseignant')) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        $enseignant = Enseignant::where('user_id', $user->id)->first();

        if (!$enseignant) {
            return response()->json(['message' => 'Enseignant non trouvé'], 404);
        }

        // Get all students in our classes
        $etudiants = Etudiant::with('promotion', 'classe', 'notes')
            ->get();

        return response()->json([
            'enseignant' => $enseignant->load('matieres'),
            'etudiants' => $etudiants,
        ]);
    }
}
