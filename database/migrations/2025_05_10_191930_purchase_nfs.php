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
    Schema::create('purchase_nfs', function (Blueprint $table) {
    $table->id();
    $table->string('nf_number')->unique(); 
    $table->date('issue_date');                     // Data de emissão
    $table->string('vendor');                     // Nome do fornecedor
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('purchase_nfs');
    }
};
