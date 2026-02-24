<?php 

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    protected $fillable = ['code','coeff'];

    public function enseignants()
    {
        return $this->belongsToMany(Enseignant::class,'matiere_enseignant','idMatiere','idEnseignant');
    }
}