<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <center>
    <img class="navbar-brand-full" src="img/encabezado.png" width="600" height="75px" alt="encabezado" text-align:center style="margin-left:3cm;margin-right:3cm">
    </center>
    <title>Partida de nacimiento</title>
    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 0.875rem;
            font-weight: normal;
            line-height: 1.5;
            color: #151b1e;           
        }

    
        #pie {
        position: fixed;
        width: 100%;
        height: 100px;
        top: auto;
        right: 0;
        bottom: 0px;
        left: 0;
        margin-left:2cm;margin-right:3cm

      }
    </style>

</head>
<body>
@foreach ($nacimientos as $n)
    
    <div style="margin-top:0.5cm;margin-left:2cm;font-family: Arial;font-size: 10pt;text-align: justify">
    <strong> LA  INFRASCRITA JEFA DEL REGISTRO DEL ESTADO FAMILIAR.</strong>
    </div>
    <div style="margin-top:0.5cm;margin-left:2cm;margin-right:2cm;font-family: Arial;font-size: 10pt;text-align: justify">
    <strong> CERTIFICA:
    
    <?php
        function comDUI($otra)
        {
            $otra2='';
            for($i=0;$i<strlen($otra);$i++){
                switch($otra{$i})
            {
                case 1:
                $otra2 .=' uno';
                break;
                case 2:
                $otra2 .=' dos';
                break;
                case 3:
                $otra2 .=' tres';
                break;
                case 3:
                $otra2 .=' tres';
                break;
                case 4:
                $otra2 .=' cuatro';
                break;
                case 5:
                    $otra2 .=' cinco';
                break;
                case 6:
                    $otra2 .=' seis';
                break;
                case 7:
                    $otra2 .=' siete';
                break;
                case 8:
                    $otra2 .=' ocho';
                break;
                case 9:
                    $otra2 .=' nueve';
                break;
                case 0:
                    $otra2 .=' cero';
                break;
            } 
            } 
            return $otra2;
        }
        function numero($otra)        {

            $completa='';
            $completa .=NumeroALetras::convertir($otra);

            return $completa;

        }
        function fecha($otra)
        {
            $completa='';
            $dia=substr($otra,0,2);
            $mes=substr($otra,5,2);
            $anio=substr($otra,-4);


            $completa .=NumeroALetras::convertir($dia);
            $completa .=' DE ';
            $completa .=fechaMes($mes);
            $completa .=' DE ';
//            $completa .=$anio;
            $completa .=NumeroALetras::convertir($anio);

            return $completa;

        }
        function fecha2($otra)
        {
            $fecha=date('d/m/YYYY');
           $completa='';
            $dia=substr($fecha,0,2);
            $mes=substr($fecha,5,2);
            $anio=substr($fecha,8,4);
           /*  
            
            


            $completa .=NumeroALetras::convertir($dia);
            $completa .=' DE ';
            $completa .=fechaMes($mes);
            $completa .=' DE ';
//            $completa .=$anio;
            $completa .=NumeroALetras::convertir($anio);
*/
            $completa .=NumeroALetras::convertir($dia);
            $completa .=' DE ';
            $completa .=fechaMes($mes);
            $completa .=' DE ';
            $completa .=NumeroALetras::convertir($anio);

            return $completa;

        }
        function hora($otra)
        {
            $completa='';
            $horas=substr($otra,0,2);
            $minutos=substr($otra,-2);


            $completa .= NumeroALetras::convertir($horas);
            $completa .=' HORAS Y ';
            $completa .=NumeroALetras::convertir($minutos);
            $completa .=' MINUTOS ';

            
            return strtolower($completa);

        }

    

        function fechaMes($otra)
        {
            $otra2='';
            switch($otra{0})
            {
                case 0:
                    switch($otra{1})
            {
                case 1:
                    $otra2 ='ENERO';
                break;
                case 2:
                    $otra2 ='FEBRERO';
                break;
                case 3:
                    $otra2 ='MARZO';
                break;
                case 4:
                    $otra2 ='ABRIL';
                break;
                case 5:
                    $otra2 ='MAYO';
                break;
                case 6:
                    $otra2 ='JUNIO';
                break;
                case 7:
                    $otra2 ='JULIO';
                break;
                case 8:
                    $otra2 ='AGOSTO';
                break;
                case 9:
                    $otra2 ='SEPTIEMBRE';
                break;
            }
                break;
                case 1:
                    switch($otra)
                    {
                        case 10:
                             $otra2 ='OCTUBRE';
                        break;
                        case 11:
                            $otra2 ='NOVIEMBRE';
                        break;
                        case 12:
                            $otra2 ='DICIEMBRE';
                        break;
                     }
                break;
            }
            return $otra2;
        }


    ?>
    
     </strong> Que a páginas {{$n->paginas}}, del Libro del Registro del Estado Familiar de Partidas de   Nacimiento que esta Alcaldía llevó a cabo en el año<strong> {{date('Y')}}</strong>, se encuentra asentada la partida que literalmente dice así: “Partida número  {{numero($n->numeropartida)}}.  <strong>{{strtoupper($n->nombres)}}</strong>
    ,sexo {{$n->sexo}},nació a las {{hora($n->hora)}} del <strong>DIA {{fecha($n->fecha)}}</strong>, en el {{$n->lugarnacimiento}}  @if ($n->sexo =='masculino') hijo 
    @else hija @endif de {{$n->nombres_padre}} {{$n->apellidos_padre}},de {{$n->edad_padre}}, {{$n->oficio_padre}}, originario de {{$n->origen_padre}},
    y de {{$n->nombres_madre}} {{$n->apellidos_madre}}, 
    de {{$n->edad_madre}}, {{$n->oficio_madre}},
    {{comDUI($n->dui_madre)}},
     {{$n->origen_madre}},{{$n->descripcion}}. Dio estos datos el señor {{$n->nombres_tutor}} {{$n->apellidos_tutor}}, quien manifiesta {{$n->manifiesto_tutor}}, 
     exhibió su Documento Único de Identidad número {{comDUI($n->dui_tutor)}},expedido en {{$n->expedido_tutor}} y firma juntamente con el infrascrito alcalde y secretario que autoriza. Alcaldía Municipal: San Antonio Masahuat,  cuatro  de febrero  de dos mil diecinueve.  M. A. R. R. // R. G. E. N.   Jefa del Ref.  ////////////Rubricadas.<strong> ES CONFORME CON SU ORIGINAL CON EL CUAL SE CONFRONTO. </strong> Y para efectos de Ley, 
     se expide la presente en la Alcaldía Municipal de San Antonio Masahuat, 
     {{fecha2($n->fecha_expedicion)}}.
     </div>
     <div style="margin-top:0.5cm;margin-left:2cm;margin-right:2cm;font-family: Arial;font-size: 10pt;text-align: center">

     <br> <br> <br> <br> <br> <br>
     
     <br> <br> <br> <br> <br> <br>
     <strong> Rosa Glenda Espinoza Nolasco</strong>
     <br>
     <strong>           JEFE DEL REGISTRO DEL ESTADO FAMILIAR </strong>

     
     
     </div>
   <div id="pie"><img class="navbar-brand-full" src="img/pie.png" width="600" height="100" alt="encabezado" text-align:center ></div>
   @endforeach  
</body>

</html>