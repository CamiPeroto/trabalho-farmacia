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
           Schema::create('stock', function (Blueprint $table) {
            $table->id(); //PK, será usado em medicines itens-sale
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('purchase_nf_item_id')->nullable()->constrained('purchase_nf_items'); //rastrear a origem do item pela NF
            $table->foreignId('branch_id')->constrained()->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('unitary_price', 10, 2);
            $table->date('expiration_date'); //data de validade
            $table->date('entry_date'); //quando foi adicionado ao estoque
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
          Schema::dropIfExists('stock');
    }
};
