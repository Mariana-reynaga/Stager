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
            $table->unsignedTinyInteger('social_fk');
            $table->foreign('social_fk')->references('id_social')->on('social_media');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comissions', function (Blueprint $table) {
            $table->dropColumn('social_fk');
        });
    }
};
