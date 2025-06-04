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
        Schema::table('users', function (Blueprint $table) {
        $table->foreignId('drugstore_id')
              ->nullable()
              ->constrained()
              ->nullOnDelete(); // Se a filial for apagada, o campo será definido como NULL
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('users', function (Blueprint $table) {
        $table->dropForeign(['drugstore_id']);
        $table->dropColumn('drugstore_id');
    });
    }
};
