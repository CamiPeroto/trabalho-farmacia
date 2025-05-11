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
            Schema::create('medicines', function (Blueprint $table) {
            $table->id(); //PK para estoque
            $table->foreignId('active_ingredient_id')->constrained('active_ingredients');//Fk de principio ativo
            $table->string('fantasy_name');
            $table->string('type'); //'genérico','Referência', 'Similar'
            $table->string('form'); //"comprimido", "xarope", "solução injetável"
            $table->string('dosage'); //"500mg", "20mg/ml"
            $table->string('maker'); //"EMS", "Medley", "Bayer"
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
