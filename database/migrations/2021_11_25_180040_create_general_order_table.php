<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_order', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario');
            $table->string('fecha_compra')->nullable();
            $table->decimal('monto_total')->nullable();
            $table->string('codigo_compra')->nullable();
            $table->text('direccion');
            $table->text('referencia');
            $table->foreignId('departamento');
            $table->foreignId('provincia');
            $table->foreignId('distrito');
            $table->string('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_order');
    }
}
