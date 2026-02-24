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
       Schema::create('etudiants', function (Blueprint $table) {
    $table->id();
    $table->string('nom');
    $table->date('dtn');
    
    $table->foreignId('idpromotion')->constrained('promotions')->onDelete('cascade');
    $table->foreignId('idclasse')->constrained('classes')->onDelete('cascade');
    
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};
