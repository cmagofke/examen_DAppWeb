<nav class="navbar navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <div class="navbar-brand">
                <img src="images/u15.png" alt="Lo Tenemos Todo"/>
            </div>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            <span class="navbar-brand">
            </span> </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav navbar-left">
            <?php include 'cargamenu.php';?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li style="white-space: nowrap"><a data-toggle="tooltip" data-placement="left" title="cerrar sesion" href="logout.php"><h6><?PHP echo $_SESSION['nombre_usuario'] . ' ' . $_SESSION['apellido_usuario'] ?> <span class="glyphicon glyphicon-log-out"> </span></h5></a></li>
            </ul>
        </div>
    </div>
</nav>
           