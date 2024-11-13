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
        Schema::table('comisiones', function (Blueprint $table) {
            $table->unsignedTinyInteger('pagos_fk');
            $table->foreign('pagos_fk')->references('id_metodo_pago')->on('metodo_pagos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comisiones', function (Blueprint $table) {
            $table->dropColumn('pagos_fk');
        });
    }
};
