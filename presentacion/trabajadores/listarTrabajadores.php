<?php
require_once realpath(dirname(__FILE__)) . "/../../../negocio/class.trabajador.php";
?>
<head>
    <script src="../js/bootbox.min.js" type="text/javascript"></script>
    <script src="../js/trabajador.js" type="text/javascript"></script>
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

                                        <th>RUT</th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th> 
                                        <th>Cargo</th>
                                        <th>Email</th>
                                        <th>Telefono</th>
                                        <th>Permisos</th>
                                        <th>Contraseña</th>
                                        <th>Opciones</th>
                                        <th>Usuario</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $pag = new trabajador();
                                    $usuario = $pag->obtieneInfo();
                                    for ($i = 0; $i < count($usuario); $i++) {
                                        ?>
                                        <tr>
                                            <td><?php echo $usuario[$i]['rut'] . '<br>'; ?>
                                            <td><?php echo $usuario[$i]['nombre'] . '<br>'; ?>
                                            <td><?php echo $usuario[$i]['apellidos'] . '<br>'; ?>
                                            <td><?php echo $usuario[$i]['cargo'] . '<br>'; ?>
                                            <td><?php echo $usuario[$i]['correo'] . '<br>'; ?>
                                            <td><?php echo $usuario[$i]['telefono'] . '<br>'; ?>
                                            <td><?php echo $usuario[$i]['permisos'] . '<br>'; ?>
                                            <td><?php echo $usuario[$i]['contrasena'] . '<br>'; ?>

                                            <td><form method='post' action='' align="center">
                                                    <input type='hidden' name='nombre' value='<?php echo $usuario[$i]['rut'] ?>'>	
                                                    <input type="button" value='Detalles' class="btn btn-info btn-xs view_data" style="background:#0288d1">
                                                    <input type="button" name="edit" value="Editar" onclick="fn_abreFormTrabajadorModificar('<?php echo $usuario[$i]['rut'] ?>')" class="btn btn-info btn-xs edit_data" style="background:#0288d1 ">
                                                </form></td>
                                            <td> 
                                                <?php if ($usuario[$i]['estado'] == 'Activo') { ?>
                                                    <br> <?php
                                                    echo "Activo";
                                                } else {
                                                    ?>
                                                    <br> <?php
                                                    echo "Inactivo";
                                                }
                                                ?></td>
                                        </tr>

                                    <?php } ?>


                                </tbody>
                            </table>
                            <input type="button" onclick="fn_abreFormTrabajador()" value='Agregar Trabajador' class="btn btn-info btn-xs view_data" style="background:#0288d1">
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
