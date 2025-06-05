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
        Schema::table('comissions', function (Blueprint $table) {
            $table->unsignedTinyInteger('payment_fk');
            $table->foreign('payment_fk')->references('id_payment_method')->on('payment_methods');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comissions', function (Blueprint $table) {
            $table->dropColumn('payment_fk');
        });
    }
};
