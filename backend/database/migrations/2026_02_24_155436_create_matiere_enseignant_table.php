<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('matiere_enseignant', function (Blueprint $table) {
    $table->id();
    $table->foreignId('idMatiere')->constrained('matieres')->onDelete('cascade');
    $table->foreignId('idEnseignant')->constrained('enseignants')->onDelete('cascade');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matiere_enseignant');
    }
};
