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
        Schema::create('usuari_resols', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Incidencia');
            $table->foreign('Incidencia')->references('id')->on('incidencias')->onDelete('cascade');
            $table->unsignedBigInteger('Usuari');
            $table->foreign('Usuari')->references('id')->on('usuaris');
            $table->Datetime('Inici');
            $table->Datetime('Final');
            $table->string('Comentaris', 500);
            $table->enum('Estat', ['Solucionada', 'En manteniment']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuari_resols');
    }
};
