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
        <h5 style="color: white;"><i class="fa fa-book" style="font-size: 20px;"></i>  Modificacion de Ganacia</h5>
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
          <h5>Modificar Ganancia</h5>
          <hr>
          <br>
          <?php
          require 'conexion/db.php';
          require 'conexion/conexion.php';
          $query_orden=mysqli_query($conn,"select * from iva");
          while($rw=mysqli_fetch_array($query_orden))
          {
          ?>          
          <form action="procesos/modificariva.php?id=<?php echo $rw['id_valor']; ?>" method="post">
                      
            <div class="form-row">
                <label>Ganancia: (Valor expresado en Porcentaje)</label>
                <input type="text" class="form-control" id="dato_uno" name="dato_uno" value="<?php echo $rw['valor']; ?>" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
            </div>
            <br>
            <div class="form-row">
              <button type="submit" class="btn btn-primary btn-block">Modificar Ganancia</button>
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

