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
        Schema::table('usuarios', function (Blueprint $table) {
            $table->unsignedTinyInteger('intentos_fallidos')
                ->default(0)
                ->after('ultima_conexion');

            $table->timestamp('bloqueado_hasta')
                ->nullable()
                ->after('intenros_fallidos');

            $table->string('token_sesion', 150)
                ->nullable()
                ->after('bloqueado_hasta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {

            $table->dropColumn([
                'intentos_fallidos',
                'bloqueado_hasta',
                'token_sesion',
            ]);
        });
    }
};
