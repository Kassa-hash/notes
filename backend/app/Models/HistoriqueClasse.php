<?php 

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class HistoriqueClasse extends Model
{
    protected $fillable = ['idEtudiant','idClasse','dateentree'];
}