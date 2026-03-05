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
        Schema::create('candidats_offres', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('offre_id');
            $table->unsignedBigInteger('candidat_id');
            $table->timestamps();
    
            $table->foreign('offre_id')->references('id')->on('offres')->onDelete('cascade');
            $table->foreign('candidat_id')->references('id')->on('candidats')->onDelete('cascade');
            $table->unique(['offre_id', 'candidat_id']);
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidats_offres');
    }
};
