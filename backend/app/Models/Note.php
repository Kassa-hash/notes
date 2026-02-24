<?php 

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = ['idMatiere','idEtudiant','note'];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class,'idEtudiant');
    }

    public function matiere()
    {
        return $this->belongsTo(Matiere::class,'idMatiere');
    }
}
?>