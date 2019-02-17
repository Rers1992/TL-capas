<?php
include_once 'Library/Session.php';
$blog = new blog();
if (isset($_POST['grabar']) and $_POST['grabar'] == 'si') {
    $blog->nueva_sesion();
} else {
    
}
?>
<!DOCTYPE html>
<html lang="en">
    <head> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

        <!-- Website CSS style -->
        <link href="presentacion/assets/css/login.css" rel="stylesheet" type="text/css"/>

        <!-- Website Font style -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

        <!-- Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

        <title>Tarapaca labs</title>
    </head>
    <body>
        <div class="container">
            <div class="row main">
                <div class="panel-heading">
                    <div class="panel-title text-center">
                        <h1 class="title">Tarapaca labs</h1>
                        <hr />
                    </div>
                </div> 
                <div class="main-login main-center">
                    <form class="form-horizontal" method="post" action="#">
                        <div class="form-group">
                            <label for="username" class="cols-sm-2 control-label">Usuario</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="nom" id="username"  placeholder="Enter your Username"/>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="grabar" value="si">
                        <div class="form-group">
                            <label for="password" class="cols-sm-2 control-label">Contraseña</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control" name="pass" id="password"  placeholder="Enter your Password"/>
                                </div>
                            </div>
                            <?php
                            if (isset($_GET['usuario'])) {
                                ?>
                            </div>
                            <?php
                            switch ($_GET['usuario']) {
                                case 'no_existe':
                                    ?>
                                    Los datos introducidos no existen
                                <?php
                                case 'sin_permiso':
                                    ?>
                                    No tiene permisos
                                <?php
                            }
                        }
                        ?>
                        <br>
                        <div class="form-group ">
                            <button type="submit" class="btn btn-primary btn-lg btn-block login-button">Ingresar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="//code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>
