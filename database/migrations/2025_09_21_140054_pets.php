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
            Schema::create('pets', function (Blueprint $table) {
            $table->id(); //PK para sales
            $table->foreignId('client_id')->constrained('clients');
            $table->foreignId('species_id')->constrained('species');
            $table->string('name')->nullable();
            $table->string('race');
            $table->string('age')->nullable();
            $table->string('weight');
            $table->text('description');
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
