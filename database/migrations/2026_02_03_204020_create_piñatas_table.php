4<?php

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
        Schema::create('piñatas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('tamano');
            $table->decimal('precio');
            $table->integer('stock');
            $table->string('material');
            $table->foreignId('categoria_id');
            $table->string('imagen_url')->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('piñatas');
    }
};
