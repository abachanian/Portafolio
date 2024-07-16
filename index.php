<?php include("./cabecera.php"); ?>
<?php include("./conexion.php"); ?>
<?php 
    $objConexion= new conexion();
    $proyectos= $objConexion->consultar("SELECT * FROM `proyectos`");
?>
<div class="p-5 bg-white">
    <div class="h-10 p-5 text-white bg-primary border rounded-3">
        <h1 class="display-3">Bienvenidos!</h1>
        <p class="lead">Este es mi portafolio de prueba en PHP</p>
        <hr class="my-2">
        <p>más información</p>
    </div>

    <div class="row row-cols-1 row-cols-md-2 g-4">
<?php  foreach($proyectos as $proyecto){?>

  <div class="col">
    <div class="card">
      <img src="./Assets/<?php echo $proyecto['imagen'] ?>" class="card-img-top" alt="5">
      <div class="card-body">
        <h5 class="card-title"><?php echo $proyecto['nombre'] ?></h5>
        <p class="card-text"><?php echo $proyecto['descripcion'] ?></p>
      </div>
    </div>
  </div>
    
<?php  }?>  
</div>


<?php include("./pie.php"); ?>