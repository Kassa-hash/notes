<?php 

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    protected $fillable = ['nom','dateentree'];

    public function matieres()
    {
        return $this->belongsToMany(Matiere::class,'matiere_enseignant','idEnseignant','idMatiere');
    }
}