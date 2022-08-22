<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipocombustiblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipocombustibles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombequipo',100);
            $table->string('descripcionequipo',256)->nullable();
            $table->timestamps();
        });
         DB::table('tipocombustibles')->insert(array('id'=>'1','nombequipo'=>'Bus Internacional - Placa N5268','descripcionequipo'=>'Bus Amarillo de uso Municipal'));
         DB::table('tipocombustibles')->insert(array('id'=>'2','nombequipo'=>'Pick Up Toyota Hilux Café - Placa N15108','descripcionequipo'=>'Vehículo Municipal Hilux Café'));
         DB::table('tipocombustibles')->insert(array('id'=>'3','nombequipo'=>'Pick Up Toyota Hilux Gris Claro - Placa N10436','descripcionequipo'=>'Vehículo Municipal Hilux Gris Claro'));
         DB::table('tipocombustibles')->insert(array('id'=>'4','nombequipo'=>'Pick Up Mazda Gris - Placa N13679','descripcionequipo'=>'Vehículo Municipal Mazda Gris'));
         DB::table('tipocombustibles')->insert(array('id'=>'5','nombequipo'=>'Pick Up Kia Blanco - Placa N8822','descripcionequipo'=>'Vehículo Municipal Kia Blanco'));
         DB::table('tipocombustibles')->insert(array('id'=>'6','nombequipo'=>'Camión Compactador Blanco - Placa N19007','descripcionequipo'=>'Camión Municipal Compactador Blanco'));
         DB::table('tipocombustibles')->insert(array('id'=>'7','nombequipo'=>'Camión Recolector - Placa N105-12','descripcionequipo'=>'Camión Municipal Recolector'));
         DB::table('tipocombustibles')->insert(array('id'=>'8','nombequipo'=>'Camión Cisterna - Placa N5653','descripcionequipo'=>'Camión Municipal Cisterna'));
         DB::table('tipocombustibles')->insert(array('id'=>'9','nombequipo'=>'Moto Yamaha Blanco - Placa M134688','descripcionequipo'=>'Motocicleta Municipal Yamaha Blanco'));
         DB::table('tipocombustibles')->insert(array('id'=>'10','nombequipo'=>'Moto Yamaha Negro - Placa M134665','descripcionequipo'=>'Motocicleta Municipal Yamaha Negro'));
         DB::table('tipocombustibles')->insert(array('id'=>'11','nombequipo'=>'Moto Freedom Rojo - Placa M481636','descripcionequipo'=>'Motocicleta Municipal Freedom Rojo'));
         DB::table('tipocombustibles')->insert(array('id'=>'12','nombequipo'=>'Moto Freedom Negro - Placa M481637','descripcionequipo'=>'Motocicleta Municipal Freedom Negro'));
         DB::table('tipocombustibles')->insert(array('id'=>'13','nombequipo'=>'Moto Honda Rojo - Placa M4742','descripcionequipo'=>'Motocicleta Municipal Honda Rojo'));
         DB::table('tipocombustibles')->insert(array('id'=>'14','nombequipo'=>'01 - Motoguadaña Sthil 280','descripcionequipo'=>'Maquina Municipal #01 Para mantenimiento de vías'));
         DB::table('tipocombustibles')->insert(array('id'=>'15','nombequipo'=>'02 - Motoguadaña Sthil 280','descripcionequipo'=>'Maquina Municipal #02 Para mantenimiento de vías'));
         DB::table('tipocombustibles')->insert(array('id'=>'16','nombequipo'=>'03 - Motoguadaña Sthil 280','descripcionequipo'=>'Maquina Municipal #03 Para mantenimiento de vías'));
         DB::table('tipocombustibles')->insert(array('id'=>'17','nombequipo'=>'04 - Motosierra Sthil MS310','descripcionequipo'=>'Maquina Municipal #04 Para chapoda de arboles'));
         DB::table('tipocombustibles')->insert(array('id'=>'18','nombequipo'=>'05 - Cortagrama Troy-Bilt 1I160K90627','descripcionequipo'=>'Maquina Municipal #05 Para Mantenimiento de canchas'));
         DB::table('tipocombustibles')->insert(array('id'=>'19','nombequipo'=>'06 - Cortagrama Troy-Bilt 1I160K90256','descripcionequipo'=>'Maquina Municipal #06 Para Mantenimiento de canchas'));
         DB::table('tipocombustibles')->insert(array('id'=>'20','nombequipo'=>'07 - Cortagrama Troy-Bilt 1LI45K93040','descripcionequipo'=>'Maquina Municipal #07 Para Mantenimiento de canchas'));
         DB::table('tipocombustibles')->insert(array('id'=>'21','nombequipo'=>'08 - Cortagrama Troy-Bilt TB120','descripcionequipo'=>'Maquina Municipal #08 Para Mantenimiento de canchas'));
         DB::table('tipocombustibles')->insert(array('id'=>'22','nombequipo'=>'09 - Cortagrama Poulan-Pro 550E','descripcionequipo'=>'Maquina Municipal #09 Para Mantenimiento de canchas'));
         DB::table('tipocombustibles')->insert(array('id'=>'23','nombequipo'=>'10 - Cortagrama Briggs & Straton 1CI33KF1803','descripcionequipo'=>'Maquina Municipal #10 Para Mantenimiento de canchas'));
         DB::table('tipocombustibles')->insert(array('id'=>'24','nombequipo'=>'11 - Cortagrama Troy-Bilt','descripcionequipo'=>'Maquina Municipal #11 Para Mantenimiento de canchas'));
         DB::table('tipocombustibles')->insert(array('id'=>'25','nombequipo'=>'12 - Bomba achicadora Honda WB30XH','descripcionequipo'=>'Bomba Municipal #12 para Riego de canchas'));
         DB::table('tipocombustibles')->insert(array('id'=>'26','nombequipo'=>'13 - Bomba achicadora Honda WB30XH','descripcionequipo'=>'Bomba Municipal #13 para Riego de canchas'));
         DB::table('tipocombustibles')->insert(array('id'=>'27','nombequipo'=>'14 - Motosierra Toolcraft TC3417','descripcionequipo'=>'Máquina Municipal #14 para chapoda de árboles'));
         DB::table('tipocombustibles')->insert(array('id'=>'28','nombequipo'=>'15 - Motosierra Toolcraft TC3417','descripcionequipo'=>'Máquina Municipal #15 para chapoda de árboles'));
         DB::table('tipocombustibles')->insert(array('id'=>'29','nombequipo'=>'Camión de Volteo Blanco - Placa 117443','descripcionequipo'=>'Camión Municipal para recolección de basura'));
         DB::table('tipocombustibles')->insert(array('id'=>'30','nombequipo'=>'Camión Compactador Blanco - Placa C93547','descripcionequipo'=>'Camión Municipal Compactador Blanco'));
         DB::table('tipocombustibles')->insert(array('id'=>'31','nombequipo'=>'00 - Maquinaria Municipal','descripcionequipo'=>'Todas las máquinas para uso Municipal'));













    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipocombustibles'); //Referencia a tipos de equipos 
    }
}
