<?php
 
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
 
class CreateEnergiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('energias', function (Blueprint $table) {
            $table->increments('id');
            /*$table->integer('idpersona')->unsigned();
            $table->foreign('idpersona')->references('id')->on('personas');
            $table->integer('numpuesto');
            $table->bigInteger('numcontador');
            $table->string('area',50);*/
            $table->integer('idpuesto')->unsigned();
            $table->foreign('idpuesto')->references('id')->on('puestos');
            $table->decimal('lecturaanterior',11,2);
            $table->decimal('lecturaactual',11,2);
            $table->decimal('costokwh', 11, 2);
            $table->date('fechavencimiento');
            $table->date('fechainicio');
            $table->date('fechafin');
            $table->date('mesfacturado');
            $table->date('fechaemision');
            $table->decimal('consumo', 11, 2);
            $table->decimal('totalpago', 11, 2);
            $table->boolean('estado')->default(1);
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
        Schema::dropIfExists('energias');
    }
}
