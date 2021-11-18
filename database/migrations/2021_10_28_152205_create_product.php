<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion');
            $table->string('estado');
            $table->integer('stock');
            $table->decimal('precio');
            $table->foreignId('subcategoria');
            $table->string('imagen');
            $table->string('imagen1')->nullable();
            $table->string('imagen2')->nullable();
            $table->string('imagen3')->nullable();
            $table->string('imagen4')->nullable();
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
        Schema::dropIfExists('product');
    }
}
