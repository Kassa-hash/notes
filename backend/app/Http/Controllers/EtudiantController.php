<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    public function getMyNotes(Request $request)
    {
        $user = $request->user();

        if (!$user || !$user->hasRole('etudiant')) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        // Get the student record by user_id
        $etudiant = Etudiant::where('user_id', $user->id)->first();

        if (!$etudiant) {
            return response()->json(['message' => 'Étudiant non trouvé'], 404);
        }

        $notes = $etudiant->notes()->with('matiere')->get();

        return response()->json([
            'etudiant' => $etudiant->load('promotion', 'classe'),
            'notes' => $notes,
        ]);
    }
}
