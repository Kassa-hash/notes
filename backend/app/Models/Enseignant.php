<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    protected $fillable = ['nom','dateentree','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function matieres()
    {
        return $this->belongsToMany(Matiere::class,'matiere_enseignant','idEnseignant','idMatiere');
    }
}