<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Factura de Energía Eléctrica</title>
    <center>
    <img class="navbar-brand-full" src="img/encabezado.jpg" width="600" height="75px" alt="encabezado" text-align:center style="margin-left:3cm;margin-right:3cm">
    </center>
    <style>
        body {
        /*position: relative;*/
        /*width: 16cm;  */
        /*height: 29.7cm; */
        /*margin: 0 auto; */
        /*color: #555555;*/
        /*background: #FFFFFF; */
        font-family: Arial, sans-serif; 
        font-size: 14px;
        /*font-family: SourceSansPro;*/
        }
 
        #logo{
        float: left;
        margin-top: 1%;
        margin-left: 2%;
        margin-right: 2%;
        }
 
        #imagen{
        width: 100px;
        }
 
        #datos{
        float: left;
        margin-top: 0%;
        margin-left: 2%;
        margin-right: 2%;
        /*text-align: justify;*/
        }
 
        #encabezado{
        text-align: center;
        margin-left: 10%;
        margin-right: 35%;
        font-size: 15px;
        }
 
        #fact{
        /*position: relative;*/
        float: right;
        margin-top: 2%;
        margin-left: 2%;
        margin-right: 2%;
        font-size: 20px;
        }
 
        section{
        clear: left;
        }
 
        #cliente{
        text-align: left;
        }
 
        /*Estilos de id para textos de tabla de fechas*/
        #fac{
        color: #0c2740;
        font-size: 15px;
        }
        #ff{
        color: #0c2740;
        font-size: 15px;
        }
        #puesto{
        color: #0a1724;
        font-size: 30px;
        }
        
        #far{
        color: #0c2740;
        font-size: 15px;
        }
        #fa{
        color: #FFFFFF;
        font-size: 14px;
        }
        #fsu{
        font-size: 16px;
        }
        #h2{ 
        color: #0c2740; 
        }
        /* Fin de estilos de textos en tablas de fechas*/

        #facfecha{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }
 
        #facfecha thead{
        padding: 20px;
        background: #96bce0;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;  
        }
 
        #facliente{
        width: 40%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #facliente thead{
        padding: 20px;
        background: #96bce0;
        text-align: left;
        border-bottom: 1px solid #FFFFFF;  
        }
 
        #facarrendatario{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }
 
        #facarrendatario thead{
        padding: 20px;
        background: #96bce0;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;  
        }
 
        #facconsumo{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }
 
        #facconsumo thead{
        padding: 20px;
        background:#2183E3;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;  
        }
 
        #info{
        text-align: center; 
        color: #4D4B4B;
        font-size: 12px;
        }
    </style>
    <body>
    <br>
    <br>
    <br>
        @foreach ($energias as $e)
        <header>
        <section>
            <div>
            <table id="facfecha">
                    <thead>
                        <tr id="ff">
                            <th>NÚMERO DE PUESTO</th>
                            <th>NÚMERO DE CONTADOR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="puesto" style="text-align: center">{{$e->numpuesto}}</td>
                            <td id="contador" style="text-align: center">{{$e->numcontador}}</td>
                        </tr>
                    </tbody>
                </table>
                <table id="facfecha">
                    <thead>
                        <tr id="ff">
                            <th>PERÍODO</th>
                            <th>MES FACTURADO</th>
                            <th>FECHA EMISIÓN</th>
                            <th>FECHA DE VENCIMIENTO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center">Desde:{{date('d/m/Y', strtotime($e->fechainicio))}}<br>Hasta:{{date('d/m/Y', strtotime($e->fechafin))}}</td>
                            <td style="text-align: center">{{ date('m/Y', strtotime($e->mesfacturado)) }}</td>
                            <td style="text-align: center">{{ date('d/m/Y', strtotime($e->fechaemision)) }}</td>
                            <td style="text-align: center"><strong>{{ date('d/m/Y', strtotime($e->fechavencimiento)) }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        </header>
        <br>
        <br>
       
        @endforeach
        <br>
        <br>
        <section>
            <div>
                <table id="facarrendatario">
                    <thead>
                        <tr id="far">
                            <th>NOMBRE DE ARRENDATARIO</th>
                            <th>ÁREA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center">{{$e->nombre_persona}}</td>
                            <td style="text-align: center">{{$e->area}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <br>
        <br>
        <br>
        <br>
        <br>
        <section>
            <div>
                <hr>
                <h2 id= "h2" style="text-align: center">DATOS DE LECTURAS Y CONSUMOS</h2>
                <table id="facconsumo">
                    <thead>
                        <tr id="fa">
                            <th>ANTERIOR <br>(KWH)</th>
                            <th>ACTUAL <br>(KWH)</th>
                            <th>CONSUMO DE MES <br>(KWH)</th>
                            <th>COSTO POR KWH</th>
                            <th>TOTAL A PAGAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($energias as $e)
                        <tr id="fsu">
                            <td style="text-align: center">{{$e->lecturaanterior}}</td>
                            <td style="text-align: center">{{$e->lecturaactual}}</td>
                            <td style="text-align: center">{{$e->consumo}}</td>
                            <td style="text-align: center">$ {{$e->costokwh}}</td>
                            <td style="text-align: center"><h2>$ {{$e->totalpago}}</h2></td>
                        </tr>
                        @endforeach
                    </tbody>
                 
                </table>
            </div>
        </section>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <footer>
            <div id="info">
                <p>El costo por Kwh promedio para comercio es $0.22. El precio con subsidio por parte de la municipalidad es de $0.16.</p>
                <p>En caso de retraso en pagos, se anulará el contraro de arrendamiento.</p>

            </div>
            <br>
            <br>
            <br>
            <hr>
            <center>
                <p>Barrio El Centro,Avenida Cipriano Castro y Calle El Centro<br>
                    www.tacachico.gob.sv.  mercado@tacachico.gob.sv   Tel.: 2445-9800
                </p>
            </center>        
        </footer>
    </body>
</html>