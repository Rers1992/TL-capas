<!DOCTYPE html>
<html>
    <head>
        <?php
        require_once realpath(dirname(__FILE__)) . "/../../../negocio/class.trabajador.php";

        //session_start();
        //if (!isset($_SESSION['email'])) {/*header('Location: http://acinfo.inf.unap.cl/~eriveros/ConsultaParticular/presentacion/Calendario.php');*/}

        if (empty($_POST)) {/* header('Location: http://acinfo.inf.unap.cl/~eriveros/ConsultaParticular/presentacion/Calendario.php'); */
        } else {
            $profe = $_POST['prof'];
            $hora = $_POST['reserva'];
            $nombre = $_POST['nombre'];
            $rutres = $_POST['rut'];
            $telef = $_POST['telefono'];

            $pag = new trabajador();
            $agenda = $pag->insertar_hora($profe, $hora, $nombre, $rutres, $telef);
            //header('Location: http://acinfo.inf.unap.cl/~eriveros/ConsultaParticular/presentacion/Calendario.php');
        }
        ?>
        <script src='calendario/lib/jquery.min.js'></script>
        <script src='calendario/lib/jquery-ui.min.js'></script>
        <script src='calendario/lib/moment.min.js'></script>			
        <script src="bootstrap-3.3.7-dist/js/bootstrap.js"></script>
    </head>
    <body>
        <form form action="agenda.php" method="post" id="formu">
            <input name="profesional" value="<?php echo $profe; ?>"type="hidden" id="prof" maxlength="256" required="required" id="reserva" class="active validate form-control">
        </form>
        <script>
            $(document).ready(function () {
                $('#formu').submit();
            });
        </script>
    </body>
</html>

