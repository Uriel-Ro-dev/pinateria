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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // Campos personalizados de tu tabla 'usuarios'
            $table->string('nombre');
            $table->string('apellido');
            $table->string('email')->unique(); // Laravel usa 'email' por defecto, te sugiero mantenerlo sobre 'correo'
            $table->string('password');
            $table->string('rol')->default('cliente'); // Agregamos un valor por defecto para evitar errores
            $table->string('telefono')->nullable();    // 'nullable' permite que el campo quede vacío si quieres
            $table->string('domicilio')->nullable();
            $table->string('status')->default('activo');

            // Campos de seguridad necesarios para Laravel
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
