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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id('id_empleado');

            $table->string('nombre', 100);
            $table->string('apellido_paterno', 50);
            $table->string('apellido_materno', 50)->nullable();
            
            $table->string('calle',100);
            $table->string('numero',10);
            $table->string('codigo_postal', 5);
            $table->string('colonia', 100);
            $table->string('alcaldia', 100);
            $table->string('ciudad', 100);

            $table->string('telefono', 15);
            $table->string('correo', 150)->unique();

            $table->date('fecha_contratacion');

            $table->string('foto',255)->nullable();

            $table->enum('estado', [
                'Activo',
                'Suspendido',
                'Vacaciones',
                'Baja temporal',
                'Baja',

            ])->default('Activo');

            $table->date('fecha_baja')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
