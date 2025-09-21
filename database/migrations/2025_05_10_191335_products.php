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
            Schema::create('products', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('species_id')->constrained('species');
            $table->string('name');
            $table->string('shape'); 
            $table->string('weight'); 
            $table->string('type'); 
            $table->string('maker'); 
            $table->text('code_product');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
