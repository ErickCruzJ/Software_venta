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
        Schema::create('rol_permiso', function (Blueprint $table) {
            $table->foreignId('id_rol')
                ->constrained('roles', 'id_rol')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            
            $table->foreignId('id_permiso')
                ->constrained('permisos', 'id_permiso')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->timestamp('created_at')
                ->nullable();

            $table->primary([
                'id_rol',
                'id_permiso',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rol_permiso');
    }
};
