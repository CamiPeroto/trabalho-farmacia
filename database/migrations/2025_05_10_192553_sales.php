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
          Schema::create('sales', function (Blueprint $table) {
            $table->id(); //PK para itens-sale
            //FK de clients aqui
            $table->date('sale'); //data da venda
            $table->text('description');
            $table->decimal('total_value'); //valor total
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('sales');
    }
};
