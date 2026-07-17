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
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id('id_inventario');
            $table->foreignId('id_producto')
                ->constrained('productos','id_producto')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreignId('id_usuario')
                ->constrained('usuarios','id_usuario')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->integer('cantidad');
            $table->dateTime('fecha_hora');
            $table->enum('estado',[
                'Disponible',
                'Agotado'
            ])->default('Disponible');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventarios');
    }
};
