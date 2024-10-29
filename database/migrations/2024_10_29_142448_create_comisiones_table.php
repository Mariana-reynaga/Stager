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
        Schema::create('comisiones', function (Blueprint $table) {
            $table->increments('comm_id');
            $table->string('user_id');
            $table->char('comm_title', 50);
            $table->string('comm_short_desc', length: 150);
            $table->enum('comm_client_social', ['Facebook','twitter / X', 'Instagram', 'Pixiv', 'Artstation', 'Tumblr', 'Discord', 'Bluesky' ,'Email']);
            $table->string('comm_client', length: 100);
            $table->date('due_date');
            $table->boolean('is_complete')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comisiones');
    }
};
