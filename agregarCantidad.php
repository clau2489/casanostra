<!DOCTYPE html>
<?php
session_start();
if (empty($_SESSION["usuario"])) {
    header("Location: index.php");
    exit();
}?>

<html lang="es">
<?php include 'header.php';?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.quicksearch/2.2.1/jquery.quicksearch.js"></script>

<body>  
  <div class="container-fluid mt-4">

    <!-- Titulo -->
    <div class="row">
      <div class="col-md-6">
        <h5 style="color: black;"><i class="fa fa-book" style="font-size: 20px;"></i>  Presupuesto </h5>
      </div>
      <div class="col-md-6">
      </div>       
    </div>
    <hr class="bg-white">


    <!-- Panel de botones -->
    <div class="row">
      <div class="col-md-6">
      </div>
      <div class="col-md-6 text-right">       
        <a class="btn btn-info btn-sm" href="home.php" ><i class="fa fa-arrow-left"></i> Seguir Agregando Articulos</a>
        <a class="btn btn-warning btn-sm" href="logout.php"><i class="fa fa-power-off"></i> Cerrar sesión</a>  
      </div>
        <form action="procesos/process.php" method="post" target="_blank" id="formExport">
          <input type="hidden" id="data_to_send" name="data_to_send" />
        </form>          
    </div>

    <div class="row mt-2">
      <div class="col-md-4 offset-md-4 p-2">
        <div id="seleccion" class="formulario">
          <h5>Agregar la Cantidad</h5>
          <hr>
          <br>
          <?php
          require_once ("conexion/db.php");
          require_once ("conexion/conexion.php");
          $id= $_GET['id'];                    
          $query_art=mysqli_query($conn,"select codigo, descripcion, preciofinal from articulo where id_articulo='$id'");
          while($row=mysqli_fetch_array($query_art)) { 
            ?>
              <p>Código: <?php echo $row['codigo']; ?></p><br>
              <p>Descripción: <?php echo $row['descripcion']; ?></p><br>
              <p>Precio x Unidad: $ <?php echo $row['preciofinal']; ?>.-</p><br>
              <form action="procesos/tochart.php" method="post">
                <input type="hidden" name="id_articulo" id="id_articulo" value="<?php echo $id; ?>">
                <label>Cantidad:</label>
                <input class="form-control" type="number" min="1" name="cantidad" id="cantidad"><br>
                <input class="form-control btn btn-success btn-sm" type="submit" value="Agregar al Presupuesto">
             </form>                                     
            <?php
            }
            ?>
        </div>
        <br><br><br>        
      </div>           
    </div>

  </div>
  <?php include 'footer.php';?>
</body>

</html>
