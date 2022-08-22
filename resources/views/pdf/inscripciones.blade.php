<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <center>
    <img class="navbar-brand-full" src="img/encabezado.png" width="700" height="75px" alt="encabezado" text-align:center>
    </center>
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
        #pie {
        position: fixed;
        width: 100%;
        height: 100px;
        top: auto;
        right: 0;
        bottom: 0px;
        left: 0;

      }
        .izquierda{
            float:left;
        }
        .derecha{
            float:right;
        }
    </style>
</head>
<body>
    <div>
        <h3>Listado de participantes. <span class="derecha">Fecha:{{date('d/m/Y')}}</span></h3>
    </div>
    <div>
         <table class="table table-bordered table-striped table-sm">
                      <thead>
                        <tr>
                        <th> cor </th>
                          <th>Nombre</th>
                          <th>Apellido</th>
                          <th>correo</th>
                          <th>telefono  </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($inscripciones as $p)
                        <tr>
                        <td>{{$loop->iteration}}   </td>
                            <td>{{$p->nombre}}</td>
                             <td>{{$p->apellido}}</td>
                           <td>{{$p->correo}}</td>
                          <td>{{$p->telefono}}      </td>
                       
                        </tr>
                          
                           @endforeach   
                         
                        
                      </tbody>
                    </table>
                   
    </div>
    <div class="izquierda">
        <p><strong>Total de registros: </strong>{{$cont}}</p>
    </div> 
    <div id="pie"><img class="navbar-brand-full" src="img/pie.png" width="700" height="100" alt="encabezado" text-align:center></div>   
</body>
</html>