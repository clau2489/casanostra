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
        <h5 style="color: white;"><i class="fa fa-book" style="font-size: 20px;"></i>  Modificacion de Artículo </h5>
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
        <a class="btn btn-info btn-sm" href="home.php" ><i class="fa fa-arrow-left"></i> Volver</a>
        <a class="btn btn-warning btn-sm" href="logout.php"><i class="fa fa-power-off"></i> Cerrar sesión</a>  
      </div>
        <form action="procesos/process.php" method="post" target="_blank" id="formExport">
          <input type="hidden" id="data_to_send" name="data_to_send" />
        </form>          
    </div>
    <div class="row mt-2">
      <div class="col-md-4 offset-md-4 p-2">
        <div class="formulario">
          <h5>Modificar Artículo</h5>
          <hr>
          <br>
          <?php
          require 'conexion/db.php';
          require 'conexion/conexion.php';
          $id= $_GET['id']; 
          $query_orden=mysqli_query($conn,"select * from articulo where id_articulo='$id'");
          while($rw=mysqli_fetch_array($query_orden))
          {
          ?>          
          <form action="procesos/modificar.php?id=<?php echo $rw['id_articulo']; ?>" method="post">
                      
            <div class="form-row">
                <label>Cod. de Barras</label>
                <input type="text" class="form-control" id="dato_uno" name="dato_uno" value="<?php echo $rw['codigo']; ?>" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
            </div>
            <div class="form-row">
                <label>Descripción:</label>
                <input type="text" class="form-control" name="dato_dos" id="dato_dos" value="<?php echo $rw['descripcion']; ?>" required onkeyup="javascript:this.value=this.value.toUpperCase();">        
            </div>                         
            <div class="form-row">
                <label>Precio de Compra</label>
                <input type="number" class="form-control monto" name="dato_tres" id="dato_tres" step="any" value="<?php echo $rw['preciodecompra']; ?>" required onkeyup="sumar();">
            </div>
            <div class="form-row">
              <div class="col-md-6">
                <label>Porcentaje aplicado:</label>
                <input type="number" class="form-control monto" name="dato_cuatro" id="dato_cuatro" step="any" value="<?php echo $rw['porcentaje']; ?>" required onkeyup="sumar();">                
              </div>
              <div class="col-md-6">
                <label>Ganancia:</label>
                <input class="form-control monto" name="dato_cinco" id="dato_cinco" value="<?php echo $rw['ganancia']; ?>" required>               
              </div>
            </div>
            <div class="form-row">
                <label>Precio Final</label>
                <input class="form-control monto" name="dato_seis" id="dato_seis" value="<?php echo $rw['preciofinal']; ?>" required>
                <br>
            </div> 
            <br>
            <div class="form-row">
              <button type="submit" class="btn btn-primary btn-block">Modificar Artículo</button>
            </div>            
          </form>
          <?php
          }
          ?>          
        </div>

      </div>           
    </div>


  </div>
  <?php include 'footer.php';?>
</body>
<script type="text/javascript">

function sumar() {
  var precio = document.getElementById("dato_tres").value;
  var porcentaje = document.getElementById("dato_cuatro").value;
  var ganancia = precio * porcentaje / 100;
  var total = parseFloat(precio) + parseFloat(ganancia);
  document.getElementById('dato_cinco').value = ganancia;
  document.getElementById('dato_seis').value = total;
}

// script de reemplazo de punto por coma
function Remplaza(entry) {
  out = "."; // reemplazar el .
  add = ","; // por ,
  temp = "" + entry;
  while (temp.indexOf(out)>-1) {
  pos= temp.indexOf(out);
  temp = "" + (temp.substring(0, pos) + add + 
  temp.substring((pos + out.length), temp.length));
  }
  document.subform.texto.value = temp;
}


// script de busqueda rapida en tabla
$("#search").keyup(function(){
    _this = this;
    // Muestra los tr que concuerdan con la busqueda, y oculta los demás.
    $.each($("#table tbody tr"), function() {
        if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
           $(this).hide();
        else
           $(this).show();                
    });
});

document.getElementById('submitExport').addEventListener('click', function(e) {
    e.preventDefault();
    let export_to_excel = document.getElementById('table');
    let data_to_send = document.getElementById('data_to_send');
    data_to_send.value = export_to_excel.outerHTML;
    document.getElementById('formExport').submit();
});


</script> 
</html>

