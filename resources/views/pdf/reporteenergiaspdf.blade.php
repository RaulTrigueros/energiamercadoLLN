<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <center>
    <img class="navbar-brand-full" src="img/encabezado.png" width="700" height="75px" alt="encabezado" text-align:center>
    </center>
    <title>Reporte de Consumo de Energía Eléctrica</title>
    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 0.875rem;
            font-weight: normal;
            line-height: 1.5;
            color: #151b1e;           
        }
        .table {
            display: table;
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
            border-collapse: collapse;
        }
        .table-bordered {
            border: 1px solid #c2cfd6;
        }
        thead {
            display: table-header-group;
            vertical-align: middle;
            border-color: inherit;
        }

        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }
        .table th, .table td {
            text-align: center;
            
            vertical-align: top;
            border-top: 1px solid #c2cfd6;
        }
         .table td {
            padding: 0.75rem;
        
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #c2cfd6;
        }
        .table-bordered thead th, .table-bordered thead td {
            border-bottom-width: 2px;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #c2cfd6;
        }
        th, td {
            display: table-cell;
            vertical-align: inherit;
        }
        th {
            font-weight: bold;
            text-align: -internal-center;
            text-align: left;
        }
        tbody {
            display: table-row-group;
            vertical-align: middle;
            border-color: inherit;
        }
        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }

        
        .izquierda{
            float:left;
        }
        .derecha{
            float:right;
        }
    
        #pie {
        position: fixed;
        width: 120%;
        height: 100px;
        top: auto;
        right: 0;
        bottom: 0px;
        left: 0;

      }
    </style>

</head>
<body>
    <div>
    
    <div>
        <h3>Consumo de Energía.<span class="derecha">Fecha:{{date('d/m/Y')}}</span></h3>
    </div>
    <div id="principal">
         <table class="table table-bordered table-striped table-sm">
                      <thead>
                        <tr>
                          <th>cor</th>
                          <th>Arrendatario</th>
                          <th>No. de puesto</th>
                          <th>No. de contador</th>
                          <th>Área</th>
                          <th>Lec. Anterior</th>
                          <th>Lec. Actual</th>
                         <!-- <th>Fecha Vencimiento</th>-->
                          <th>Mes Facturado</th>
                          <th>Consumo</th>
                          <th>Costo Kwh</th>
                          <th>Total a pagar</th>
                          <th>Estado</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($energias as $c)
                        <tr>
                          <td style="vertical-align:middle;">{{$loop->iteration}}   </td>
                          <td style="vertical-align:middle;">{{$c->nombre_persona}}</td>
                          <td style="vertical-align:middle;">{{$c->numpuesto}}</td>
                          <td style="vertical-align:middle;">{{$c->numcontador}}</td>
                          <td style="vertical-align:middle;">{{$c->area}}</td>
                          <td style="vertical-align:middle;">{{$c->lecturaanterior}}</td>
                          <td style="vertical-align:middle;">{{$c->lecturaactual}} </td>
                        <!--  <td style="vertical-align:middle;">{{ date('d/m/Y', strtotime($c->fechavencimiento)) }}</td>-->
                          <td style="vertical-align:middle;">{{ date('m/Y', strtotime($c->mesfacturado)) }}</td>
                          <td style="vertical-align:middle;">{{$c->consumo}} </td>
                          <td style="vertical-align:middle;">{{$c->costokwh}} </td>
                          <td style="vertical-align:middle;">${{$c->totalpago}}</td>
                          <td style="vertical-align:middle;"><strong>{{$c->estado?'No Pagado':'Pagado'}}</strong></td>
                        </tr>
                        
                           @endforeach 
                        <tr>  
                           <td></td> 
                           <td></td> 
                           <td></td> 
                           <td></td> 
                           <td></td>
                           <td></td>
                           <td></td>
                          <!-- <td></td>-->
                           <td style="vertical-align:middle;"><strong>Total de Consumo: </strong></td> 
                           <td style="vertical-align:middle;">{{$sumconsumo}} </td>
                           <td style="vertical-align:middle;"><strong>Total de pagos: </strong></td>
                           <td style="vertical-align:middle;">${{number_format($sumpagos,2)}} </td>
                           <td></td>
                        </tr>

                      </tbody>
                    
                    </table>
                    
    </div>
  
    <div class="izquierda">
        <p><strong>Total de registros: </strong>{{$cont}}</p>
    </div>  
    
   <br> 
   </div>
 <!--  <div id="pie"><img class="navbar-brand-full" src="img/pie.png" width="700" height="100" alt="encabezado" text-align:center></div>
    -->
</body>

</html>