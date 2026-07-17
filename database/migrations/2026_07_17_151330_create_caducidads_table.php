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
        Schema::create('caducidades', function (Blueprint $table) {
            $table->id('id_caducidad');
            $table->foreignId('id_inventario')
                ->constrained('inventarios','id_inventario')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->decimal('cantidad_lote_inicial', 8, 2);
            $table->decimal('cantidad_lote_final', 8, 2);
            $table->date('fecha_caducidad');
            $table->string('descripcion', 255);
            $table->enum('estado',[
                'Disponible',
                'Vencido',
                'Vendido',
            ])->default('Disponible');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caducidads');
    }
};
