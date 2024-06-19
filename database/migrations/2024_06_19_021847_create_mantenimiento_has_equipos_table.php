<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMantenimientoHasEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mantenimiento_has_equipos', function (Blueprint $table) {
            $table->unsignedBigInteger('mantenimiento_id');
            $table->foreign('mantenimiento_id')->references('id')->on('mantenimientos')->onDelete('cascade');
            $table->string('equipo_codigo_inventario');
            $table->foreign('equipo_codigo_inventario')->references('codigo_inventario')->on('equipos')->onDelete('cascade');
            $table->primary(['mantenimiento_id', 'equipo_codigo_inventario'], 'mantenimiento_equipo_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mantenimiento_has_equipos');
    }
}