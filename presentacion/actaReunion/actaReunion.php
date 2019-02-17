<?php
require_once realpath(dirname(__FILE__)) . "/../../../negocio/class.actaReunion.php";
?>

<head>
    <script src="../js/bootbox.min.js" type="text/javascript"></script>
    <script src="../js/actaReunion.js" type="text/javascript"></script>
</head>
<body>
    <div id="contenido">
        <div id="page-wrapper">
            <div class="row">
                <p></p>
                <div class="col-auto">
                    <div class="container striped card-content table-responsive" style="width:99%; 
                         word-wrap: break-word;"> 
                        <div id="employee_table">
                            <table class="highlight bordered order-table table table-bordered table-hover">
                                <thead>
                                    <tr>

                                        <th>Profesional</th>
                                        <th>Equipo</th>
                                        <th>Fecha</th> 
                                        <th>Rut Registrador</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $pag = new actaReunion();
                                    $usuario = $pag->obtieneInfo();
                                    for ($i = 0; $i < count($usuario); $i++) {
                                        ?>
                                        <tr>
                                            <td><?php echo $usuario[$i]['profesional'] . '<br>'; ?>
                                            <td><?php echo $usuario[$i]['equipo'] . '<br>'; ?>
                                            <td><?php echo $usuario[$i]['fecha'] . '<br>'; ?>
                                            <td><?php echo $usuario[$i]['rut_reg'] . '<br>'; ?>

                                            <td><form method='post' action='' align="center">
                                                    <input type='hidden' name='nombre' value='<?php echo $usuario[$i]['rut'] ?>'>	
                                                    <input type="button" value='Detalles' class="btn btn-info btn-xs view_data" style="background:#0288d1">
                                                </form></td>
                                        </tr>

                                    <?php } ?>


                                </tbody>
                            </table>
                            <input type="button" onclick="fn_abreFormActa()" value='Agregar Acta' class="btn btn-info btn-xs view_data" style="background:#0288d1">
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
            </div>
        </div>
    </div>
</body>

<div id="dataModal" class="modal fade">  
    <div class="modal-dialog">  
        <div class="modal-content">
            <div class="modal-body" id="employee_detail">  
            </div> 
        </div>  
    </div>  
</div> 