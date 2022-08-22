<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class CreateTipodocumentosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tipodocumentos', function(Blueprint $table)
		{
                    $table->increments('id');
                    $table->string('nombre',50);
                    $table->string('descripcion', 256)->nullable();
		});
                DB::table('tipodocumentos')->insert(array('id'=>'1','nombre'=>'PARTIDA NACIMIENTO'));
                DB::table('tipodocumentos')->insert(array('id'=>'2','nombre'=>'PARTIDA MATRIMONIO'));
                DB::table('tipodocumentos')->insert(array('id'=>'3','nombre'=>'PARTIDA DEFUNCIÓN'));
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tipodocumentos');
	}

}
