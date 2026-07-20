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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->foreignId('id_empleado')
                ->constrained('empleados','id_empleado')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreignId('id_rol')
                ->constrained('roles','id_rol')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->string('nombre_usuario',50);
            $table->string('password');
            $table->timestamp('ultima_conexion')->nullable();
            $table->enum('estado',[
                'Conectado',
                'Desconectado',
                'Bloqueado',
                'Suspendido',
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
