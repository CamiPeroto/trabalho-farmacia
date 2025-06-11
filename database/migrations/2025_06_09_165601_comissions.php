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
            $table->id();
            $table->foreignId('user_id')->constrained('users'); // Quem realizou a venda
            $table->foreignId('sale_id')->constrained('sales'); // Venda associada
            $table->decimal('value', 8, 2);                     // Valor da comissão
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
