<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombustiblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combustibles', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->integer('idtipocombustible')->unsigned();
            $table->string('nombre',100);
            $table->integer('numrequerimiento');//->nullable();
            $table->integer('numvale');
            $table->decimal('numgalones',10,2);
            $table->decimal('preciogalon',10,2); //10: representa 10 numeros antes del punto y 2: representa la cantidad de numeros despues del punto decimal
            $table->decimal('valorfactura',10,2);
            $table->integer('numfactura');
            $table->string('descripcion', 300)->nullable();
            $table->boolean('estado')->default(1);
           
            $table->timestamps();

            $table->foreign('idtipocombustible')->references('id')->on('tipocombustibles');
        });
        //DB::statement('ALTER TABLE combustibles ADD imagen MEDIUMBLOB');
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('combustibles');
    }
}
