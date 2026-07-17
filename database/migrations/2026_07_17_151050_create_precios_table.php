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
        Schema::create('precios', function (Blueprint $table) {
            $table->id('id_precio');
            $table->foreignId('id_producto')
                ->constrained('productos','id_producto')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->decimal('precio_venta', 10,2);
            $table->date('fecha');
            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('precios');
    }
};
