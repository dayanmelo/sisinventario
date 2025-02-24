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
        Schema::create('cierres', function (Blueprint $table) {
            $table->id();

            $table->dateTime('fecha');
            $table->decimal('precio_total',60,0);
            $table->decimal('ganancia',60,0);
            $table->unsignedBigInteger('empresa_id');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cierres');
    }
};
