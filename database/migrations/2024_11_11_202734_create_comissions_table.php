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
        Schema::create('comissions', function (Blueprint $table) {
            $table->id('com_id');
            $table->string('com_title');
            $table->text('com_description');
            $table->string('com_client');
            $table->integer('com_price');
            $table->string('com_reciept')->nullable();
            $table->date('com_due');
            $table->json('com_tasks');
            $table->json('com_notes')->default('[]');
            $table->boolean('is_complete')->default(false);
            $table->boolean('is_payed')->default(false);
            $table->integer('com_percent')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comissions');
    }
};
