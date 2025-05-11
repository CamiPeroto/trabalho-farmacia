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
    Schema::create('purchase_nf_items', function (Blueprint $table) {
    $table->id();
    $table->foreignId('purchase_nf_id')->constrained('purchase_nfs')->onDelete('cascade');
    $table->foreignId('medicine_id')->constrained('medicines');
    $table->integer('quantity');
    $table->decimal('unitary_price', 10, 2);
    $table->date('expiration_date');
    $table->string('lot')->nullable(); //lote do medicamento 
    $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('purchase_nf_items');
    }
};
