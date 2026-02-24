<?php 

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $fillable = ['libelle'];

    public function etudiants()
    {
        return $this->hasMany(Etudiant::class,'idclasse');
    }
}