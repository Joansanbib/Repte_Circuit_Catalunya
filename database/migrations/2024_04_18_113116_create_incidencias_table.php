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
        Schema::create('incidencias', function (Blueprint $table) {
            $table->id();
            $table->string('Nom', 150);
            $table->string('Descripcio', 500);
            $table->date('Data');
            $table->enum('Estat', ['Solucionada', 'Borrador', 'Informativa', 'Inactiva', 'Requereix', 'En manteniment']);
            $table->enum('Prioritat', ['Màxima', 'Mínima', 'Normal', 'Informativa', 'Poca']);
            //$table->string('Ruta_img', 150)->nullable();
            $table->enum('Rol_assignat', ['Operari', 'Administrador']);
            //$table->string('Ruta_proforma', 150);
            //$table->unsignedBigInteger('Zona');
            //$table->foreign('Zona')->references('id')->on('zonas')->onDelete('cascade');
            //$table->unsignedBigInteger('Usuari_denunciant');
            //$table->foreign('Usuari_denunciant')->references('id')->on('usuaris');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidencias');
    }
};
