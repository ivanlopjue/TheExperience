<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();

            $table->string('nombre', 50)->required();
            $table->string('mail', 100)->required();
            $table->string('telefono', 100)->required();

            $table->enum('hora',['13:30', '14:30', '20:00', '21:00'])->required();
            $table->date('fecha')->required();
            $table->integer('comensales');
            // Se crea un campo para saber el total de comensales disponibles
            $table->integer('comen_disponibles')->unsigned();
            $table->string('localizador',12)->nullable()->unique();
            $table->integer('id_usuario')->foreign('id_usuario')->references('id')->on('users')->nullable();

            $table->text('observaciones')->nullable();
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
        Schema::dropIfExists('reservas');
    }
};
