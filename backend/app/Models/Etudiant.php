<?php 

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    protected $fillable = ['nom','dtn','idpromotion','idclasse'];

    public function promotion()
    {
        return $this->belongsTo(Promotion::class,'idpromotion');
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class,'idclasse');
    }

    public function notes()
    {
        return $this->hasMany(Note::class,'idEtudiant');
    }
}
?>