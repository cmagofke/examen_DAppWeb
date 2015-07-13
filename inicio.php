<?php
session_start();
include ("librerias.php");

?> 
    <script Language="JavaScript"> 
     function DameLaFechaHora() { 
        var hora = new Date() 
        var hrs = hora.getHours(); 
        var min = hora.getMinutes(); 
        var hoy = new Date(); 
        var m = new Array(); 
        var d = new Array() 
        var an= hoy.getYear(); 
        m[0]="Enero"; m[1]="Febrero"; m[2]="Marzo"; 
        m[3]="Abril"; m[4]="Mayo"; m[5]="Junio"; 
        m[6]="Julio"; m[7]="Agosto"; m[8]="Septiembre"; 
        m[9]="Octubre"; m[10]="Noviembre"; m[11]="Diciembre"; 
        document.write("Son las "+hrs+":"+min+" ("); 
        document.write(hoy.getDate()); 
        document.write(" de "); 
        document.write(m[hoy.getMonth()]); 
        document.write(")"); 
     } 
    </script>
<!doctype html>
<html>
    <head>
        <meta charset="iso-8859-1">
        <title></title>
    </head>
    <body>
        <?php include 'menu.php'; ?>
        <div class="container">
            <div class="jumbotron">
                <td><script>DameLaFechaHora()</script></td>
                <h3>Bienvenido <?php echo($_SESSION['nombre_usuario']); ?></h3>
                <h4>Este es el sistema de la importadora "Lo Tenemos Todo".</h4> <br>
           </div>
           <?php /*
            dumpo($_SESSION);
            
            dumpo(filter_input( INPUT_SERVER, 'nombre', FILTER_UNSAFE_RAW, FILTER_NULL_ON_FAILURE ));
            
            dumpo($_SESSION['nombre']);
            */?>
        </div>
    </body>
</html>
