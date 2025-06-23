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
            $table->unsignedTinyInteger('currency_id_fk');
            $table->foreign('currency_id_fk')->references('id_payment_currency')->on('payment_currencies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comissions', function (Blueprint $table) {
            $table->dropColumn('currency_id_fk');
        });
    }
};
