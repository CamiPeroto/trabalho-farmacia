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
         Schema::create('itens_sale', function (Blueprint $table) {
            $table->id(); 
            //id_sale FK de sales aqui
            //id_stock FK de stock aqui
            $table->int('quantity');
            $table->decimal('unitary_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('itens_sale');
    }
};
