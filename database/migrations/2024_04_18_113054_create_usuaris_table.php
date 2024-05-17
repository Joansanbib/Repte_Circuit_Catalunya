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
        Schema::create('usuaris', function (Blueprint $table) {
            $table->id();
            $table->string('NIF', 9);
            $table->string('Nom', 50)->nullable();
            $table->string('Cognoms', 150)->nullable();
            $table->date('Data_naixament')->nullable();
            $table->enum('Rol', ['Operari', 'Administrador']);
            $table->string('Lleng_preferencia', 100)->nullable();
	        $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('Perfil_xat')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuaris');
    }
};
