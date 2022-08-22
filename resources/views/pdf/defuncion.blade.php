<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <center>
    <img class="navbar-brand-full" src="img/encabezado.png" width="600" height="75px" alt="encabezado" text-align:center style="margin-left:3cm;margin-right:3cm">
    </center>
    <title>Partida de Defunción</title>
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
@foreach ($defuncion as $d)
    
    <div style="margin-top:0.5cm;margin-left:2cm;font-family: Arial;font-size: 12pt;text-align: justify">
    <strong> LA  INFRASCRITA JEFA DEL REGISTRO DEL ESTADO FAMILIAR.</strong>
    </div>
    <div style="margin-top:0.5cm;margin-left:2cm;margin-right:2cm;font-family: Arial;font-size: 12pt;text-align: justify">
     <strong> CERTIFICA: <?php
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
        
        function fecha($otra)
        {
            $completa='';
            $dia=substr($otra,8,2);
            $mes=substr($otra,5,2);
            $anio=substr($otra,0,4);


            $completa .=numero($dia);
            $completa .=' de ';
            $completa .=fechaMes($mes);
            $completa .=' de ';
            $completa .=$anio;

            return $completa;

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
                    $otra2 ='enero';
                break;
                case 2:
                    $otra2 ='febrero';
                break;
                case 3:
                    $otra2 ='marzo';
                break;
                case 4:
                    $otra2 ='abril';
                break;
                case 5:
                    $otra2 ='mayo';
                break;
                case 6:
                    $otra2 ='junio';
                break;
                case 7:
                    $otra2 ='julio';
                break;
                case 8:
                    $otra2 ='agosto';
                break;
                case 9:
                    $otra2 ='septiembre';
                break;
            }
                break;
                case 1:
                    switch($otra)
                    {
                        case 10:
                             $otra2 ='octubre';
                        break;
                        case 11:
                            $otra2 ='noviembre';
                        break;
                        case 12:
                            $otra2 ='diciembre';
                        break;
                     }
                break;
            }
            return $otra2;
        }
        
        function numero($otra)
        {
            $otra2='';

            switch($otra{0})
                    {
                        case 0:
                            $otra2 =unidad($otra);
                       break;
                        case 1:
                             $otra2 =diez($otra);
                        break;
                        case 2:
                            $otra2 =veinte($otra);
                        break;
                        case 3:
                            switch($otra)
                            {
                                case 30:
                                    $otra2 ='treinta';
                                break;
                                default:
                                    $otra2 ='treinta y '.unidad($otra);
                                break;
                            }
                        break;
                        case 4:
                            switch($otra)
                            {
                                case 40:
                                    $otra2 ='cuarenta';
                                break;
                                default:
                                    $otra2 ='cuarenta y '.unidad($otra);
                                break;
                            }
                        break;
                        case 5:
                            switch($otra)
                            {
                                case 50:
                                    $otra2 ='cincuenta';
                                break;
                                default:
                                    $otra2 ='cincuenta y '.unidad($otra);
                                break;
                            }
                        break;
                        case 6:
                            switch($otra)
                            {
                                case 60:
                                    $otra2 ='sesenta';
                                break;
                                default:
                                    $otra2 ='sesenta y '.unidad($otra);
                                break;
                            }
                        break;
                        case 7:
                            switch($otra)
                            {
                                case 70:
                                    $otra2 ='setenta';
                                break;
                                default:
                                    $otra2 ='setenta y '.unidad($otra);
                                break;
                            }
                        break;
                        case 8:
                            switch($otra)
                            {
                                case 80:
                                    $otra2 ='ochenta';
                                break;
                                default:
                                    $otra2 ='ochenta y '.unidad($otra);
                                break;
                            }
                        break;
                        case 9:
                            switch($otra)
                            {
                                case 90:
                                    $otra2 ='noventa';
                                break;
                                default:
                                    $otra2 ='noventa y '.unidad($otra);
                                break;
                            }
                        break;
                        
                     }
            return $otra2;
        }

        function unidad($otra)
        {
            $otra2='';

            switch($otra{1})
                    {
                        case 1:
                            $otra2 ='uno';
                       break;
                        case 2:
                             $otra2 ='dos';
                        break;
                        case 3:
                            $otra2 ='tres';
                        break;
                        case 4:
                            $otra2 ='cuatro';
                        break;
                        case 5:
                            $otra2 ='cinco';
                        break;
                        case 6:
                            $otra2 ='seis';
                        break;
                        case 7:
                            $otra2 ='siete';
                        break;
                        case 8:
                            $otra2 ='ocho';
                        break;
                        case 9:
                            $otra2 ='nueve';
                        break;
                     }
            return $otra2;
        }

        function diez($otra)
        {
            $otra2='';

            switch($otra)
                    {
                        case 10:
                            $otra2 ='diez';
                       break;
                        case 11:
                             $otra2 ='once';
                        break;
                        case 12:
                            $otra2 ='doce';
                        break;
                        case 13:
                            $otra2 ='trece';
                        break;
                        case 14:
                            $otra2 ='catorce';
                        break;
                        case 15:
                            $otra2 ='quince';
                        break;
                        case 16:
                            $otra2 ='dieciséis';
                        break;
                        case 17:
                            $otra2 ='diecisiete';
                        break;
                        case 18:
                            $otra2 ='dieciocho';
                        break;
                        case 19:
                            $otra2 ='diecinueve';
                        break;
                     }
            return $otra2;
        }

        
        function veinte($otra)
        {
            $otra2='';
            
            switch($otra)
                    {
                        case 20:
                            $otra2 ='veinte';
                       break;
                        case 21:
                             $otra2 ='veintiuno';
                        break;
                        case 22:
                            $otra2 ='veintidós';
                        break;
                        case 23:
                            $otra2 ='veintitrés';
                        break;
                        case 24:
                            $otra2 ='veinticuatro';
                        break;
                        case 25:
                            $otra2 ='veinticinco';
                        break;
                        case 26:
                            $otra2 ='veintiséis';
                        break;
                        case 27:
                            $otra2 ='veintisiete';
                        break;
                        case 28:
                            $otra2 ='veintiocho';
                        break;
                        case 29:
                            $otra2 ='veintinueve';
                        break;
                     }
            return $otra2;
        }
        
        
    ?>
</strong>Que a páginas {{$d->paginas}}, del Libro del Registro del Estado Familiar de Partidas de Defunción que esta oficina lleva en el año
<strong> {{$d->anio}}</strong>, se encuentra asentada la que literalmente dice: Partida número  {{strtoupper($d->numeropartida)}}.  
<strong>{{strtoupper($d->nombres)}}</strong>, sexo {{$d->sexo}}, de {{$d->edad}}, {{$d->estadofam}}, {{$d->oficio}}, originario de {{$d->lugarorigen}} y del domicilio de {{$d->domicilio}},
    de nacionalidad {{$d->nacionalidad}}, hijo de <strong>{{strtoupper($d->nombrepadre)}}</strong> y <strong>{{strtoupper($d->nombremadre)}}</strong>, falleció a las {{$d->hora}} del día {{fecha($d->fechamuerte)}},
    en {{$d->lugarmuerte}}, a consecuencia de {{$d->causa}}, @if ($d->duifallecido) se tuvo a la vista su Documento de Identidad número {{comDUI($d->duifallecido)}}.
    @else No se tuvo a la vista Documento de Identidad. @endif Dió estos datos {{$d->nombreregistrador}}, quien manifiesta ser {{$d->parentesco}} del fallecido,
    exhibió su Documento Único de Identidad {{comDUI($d->duiregistrador)}}, quien firma juntamente con la infrascrita Jefa del Registro
    de Estado Familiar y testigo {{$d->nombretestigo}}, con Documento Único de Identidad número {{comDUI($d->duitestigo)}}.<br> 
    Alcaldía Municipal San Antonio Masahuat, {{fecha($d->fechapartida)}}.
    Enmendado- con {{$d->nombreregistrador}}. Vale. V.M.R.C//A.C.G.L//S.O.C.//R.G.E.
    N. Jefa del Ref Rubricadas. <strong>ES CONFORME CON SU ORIGINAL CON EL CUAL SE CONFRONTO.</strong>
    Y para efectos de Ley, se expide la presente en la Alcaldía Municipal de San Antonio Masahuat, {{fecha(date('Y-m-d'))}}.///////////////
    <br> <br> <br> <br> <br><br>
    
    <P align="center"><strong> Rosa Glenda Espinoza Nolasco</strong></P>
    <P align="center"><strong >JEFA DEL REGISTRO DEL ESTADO FAMILIAR</strong></P>
   <div id="pie"><img class="navbar-brand-full" src="img/pie.png" width="600" height="100" alt="encabezado" text-align:center ></div>
   @endforeach  
</body>

</html>