<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <center>
    <img class="navbar-brand-full" src="img/encabezado.png" width="700" height="75px" alt="encabezado" text-align:center>
    </center>
    <title>Reporte de Consumo de combustible</title>
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
        <h3>Consumo de combustible.<span class="derecha">Fecha:{{date('d/m/Y')}}</span></h3>
    </div>
    <div id="principal">
         <table class="table table-bordered table-striped table-sm">
                      <thead>
                        <tr>
                          <th>cor</th>
                          <th>Fecha</th>
                          <th>Equipo</th>
                          <th>Operador</th>
                          <th>N° Requerimiento</th>
                          <th>N° Vale</th>
                          <th>N° Galones</th>
                          <th>Precio</th>
                          <th>Valor Factura</th>
                          <th>N° Factura</th>
                          <th>Misión</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($combustibles as $c)
                        <tr>
                          <td style="vertical-align:middle;">{{$loop->iteration}}   </td>
                          <td style="vertical-align:middle;">{{ date('d/m/Y', strtotime($c->fecha)) }}</td>
                          <td style="vertical-align:middle;">{{$c->nombre_tipocombustible}}</td>
                          <td style="vertical-align:middle;">{{$c->nombre}}</td>
                          <td style="vertical-align:middle;">{{$c->numrequerimiento}}</td>
                          <td style="vertical-align:middle;">{{$c->numvale}} </td>
                          <td style="vertical-align:middle;">{{$c->numgalones}} </td>
                          <td style="vertical-align:middle;">${{$c->preciogalon}} </td>
                          <td style="vertical-align:middle;">${{$c->valorfactura}} </td>
                          <td style="vertical-align:middle;">{{$c->numfactura}} </td>
                          <td style="vertical-align:middle;">{{$c->descripcion}}</td>
        <!-- <td>{{$c->estado?'Activo':'Desactivado'}}</td>   -->
                        </tr>
                        
                           @endforeach 
                        <tr>  
                           <td></td> 
                           <td></td> 
                           <td></td> 
                           <td></td> 
                           <td></td>
                           <td style="vertical-align:middle;"><strong>Total de Galones: </strong></td> 
                           <td style="vertical-align:middle;">{{$sumgalones}} </td>
                           <td style="vertical-align:middle;"><strong>Total de Factura: </strong></td>
                           <td style="vertical-align:middle;">${{number_format($sumfactura,2)}} </td>
                           <td></td>
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