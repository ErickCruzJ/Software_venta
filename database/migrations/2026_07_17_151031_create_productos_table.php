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
        Schema::create('productos', function (Blueprint $table) {
            $table->id('id_producto');
            $table->foreignId('id_categoria')
                ->constrained('categorias', 'id_categoria')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreignId('id_cat_marca')
                ->constrained('cat_marcas','id_cat_marca')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->string('codigo',50)->unique();
            $table->string('nombre',100);
            $table->string('descripcion',255)->nullable();
            $table->decimal('contenido',8,2);
            $table->enum('unidad_medida', [
                'pz',
                'L',
                'ml',
                'g',
                'kg',
                'oz',
            ]);
            $table->string('presentacion',50);
            $table->enum('estado',[
                'Disponible',
                'Agotado',
            ])->default('Disponible');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
