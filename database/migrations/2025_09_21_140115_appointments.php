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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id(); // PK para sales
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('time')->nullable();
            $table->string('hours')->nullable();
            $table->text('value');
            $table->text('total_value');
            $table->timestamps();
        });
    }   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
          Schema::dropIfExists('pets');
    }
};
