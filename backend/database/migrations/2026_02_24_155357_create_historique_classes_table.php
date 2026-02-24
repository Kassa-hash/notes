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
       Schema::create('historique_classes', function (Blueprint $table) {
    $table->id();
    $table->foreignId('idEtudiant')->constrained('etudiants')->onDelete('cascade');
    $table->foreignId('idClasse')->constrained('classes')->onDelete('cascade');
    $table->date('dateentree');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historique_classes');
    }
};
