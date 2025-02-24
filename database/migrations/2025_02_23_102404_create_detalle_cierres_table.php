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
        Schema::create('detalle_cierres', function (Blueprint $table) {
            $table->id();

            $table->integer('cantidad');
            $table->decimal('precio_compra',60,0);
            $table->decimal('precio_venta',60,0);
            $table->decimal('precio_total',60,0);
            $table->decimal('ganancia',60,0);


            $table->unsignedBigInteger('cierre_id');
            $table->foreign('cierre_id')->references('id')->on('cierres')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('producto_id');
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade')->onUpdate('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_cierres');
    }
};
