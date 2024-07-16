<?php include("./cabecera.php"); ?>
<?php include("./conexion.php"); ?>
<?php

    if ($_POST) {
        $nombre= $_POST['nombre'];
        $descripcion= $_POST['descripcion'];

        $fecha= new DateTime();

        $imagen=$fecha->getTimestamp()."-".$_FILES['archivo']['name'];
        $imagen_temp=$_FILES['archivo']['tmp_name'];
        move_uploaded_file($imagen_temp,"./Assets/".$imagen);

        $objConexion= new conexion();
        $sql="INSERT INTO `proyectos` (`id`, `nombre`, `imagen`, `descripcion`) VALUES (NULL, '$nombre', '$imagen', '$descripcion');";
        $objConexion->ejecutar($sql);

        header("location:portafolio.php");
    }

    if($_GET){
        
        $objConexion= new conexion();

        $imagen=$objConexion->consultar("SELECT imagen FROM `proyectos` WHERE id=".$_GET['borrar']);//*!busco el nombre de la imagen
        
            unlink("./Assets/".$imagen[0]['imagen']); //*!Borro la imagen

        $sql="DELETE FROM `proyectos` WHERE `proyectos`.`id` =".$_GET['borrar'];
        $objConexion->ejecutar($sql);

        header("location:portafolio.php");
    }

    $objConexion= new conexion();
    $proyectos= $objConexion->consultar("SELECT * FROM `proyectos`");
?>

<br/>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Datos del proyecto</div>
                <div class="card-body">
                    
                    <form action="portafolio.php" method="post" enctype="multipart/form-data"> <!-- el multipart es fundamental para recepción de archivos -->

                        Nombre del proyecto: <input required class="form-control" type="text" name="nombre" id="">
                        <br/>
                        Imagen del proyecto: <input required class="form-control" type="file" name="archivo" id="">
                        <br/>
                        <div class="mb-3">
                            <label for="" class="form-label">Descripcion:</label>
                            <textarea required class="form-control" name="descripcion" id="" rows="3"></textarea>
                        </div>
                        <br/>
                        <input class="btn btn-success" type="submit" value="Enviar proyecto">
                        
                    
                    </form>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="table-responsive">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Imágen</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  foreach($proyectos as $proyecto){?>
                        <tr class="">
                            <td scope="row"><?php echo $proyecto['id'] ?></td>
                            <td><?php echo $proyecto['nombre'] ?></td>

                            <td>
                                <img width="100" src="./Assets/<?php echo $proyecto['imagen'] ?>" alt="" srcset="">
                            </td>
                            
                            <td><?php echo $proyecto['nombre'] ?></td>
                            <td><a name="" id="" class="btn btn-danger" href="?borrar=<?php echo $proyecto['id'] ?>">Eliminar</a></td>
                        </tr>
                        <?php  }?>                        
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</div>

<?php include("./pie.php"); ?>