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
      <div class="col-md-8 offset-md-2 p-2">
        <div id="seleccion" class="formulario">
          <h5>Presupuesto</h5>
          <hr>
          <br>      
          <form action="procesos/agregar.php" method="post">
            <table class="table table-bordered table-hover table-sm bg-light" id="table">
              <thead class="bg-secondary text-white">
                  <tr>
                    <th style="width: 10%">Cod. </th>
                    <th>Descripcion</th>
                    <th style="width: 12%">Pre/u.</th>
                    <th style="width: 12%">Cant. </th>
                    <th style="width: 12%">Total </th>
                    <th style="width: 5%"></th>
                  </tr>
                </thead>
                    <?php
                    require_once ("conexion/db.php");
                    require_once ("conexion/conexion.php");
                    $query_ped=mysqli_query($conn,"select * from presupuesto");  
                    while($rw=mysqli_fetch_array($query_ped)) {
                    $idpres = $rw['id_presupuesto']; 
                    $id = $rw['id_articulo'];
                    $cant = $rw['cantidad'];  
                    ?>                
                <tbody>
                  <tr>
                    <?php
                        $query_art=mysqli_query($conn,"select codigo, descripcion, preciofinal from articulo where id_articulo='$id'");
                        while($row=mysqli_fetch_array($query_art)) { 
                        ?>
                        <td><?php echo $row['codigo']; ?></td>
                        <td><?php echo $row['descripcion']; ?></td>
                        <td>$ <?php echo $row['preciofinal']; ?>.-</td>
                        <td><?php echo $cant; ?></td>
                        <?php
                        $total = $row[2] * $cant;
                        ?>
                        <td>$ <?php echo $total; ?>.-</td>
                        <td>
                          <a class="btn btn-danger btn-small btn-sm" href="procesos/borrarchart.php?id=<?php echo $idpres; ?>"><i class="fa fa-trash"></i></a>
                        </td>                                      
                        <?php
                        }
                        ?> 
                    <?php
                    }
                    ?> 
                  </tr>
                </tbody>
                <iframe id="txtArea1" style="display:none"></iframe>
            </table>                    
            <div class="form-row">              
            </div>            
          </form>          
        </div>
        <br><br><br>
        <div class="row">
          <div class="col-md-6">
            <a href="procesos/borrarTabla.php" class="btn btn-info btn-sm" >Borrar Presupuesto</a>
          </div>
          <div class="col-md-6">
            <a href="javascript:imprSelec('seleccion')" class="btn btn-success btn-sm float-right" >Imprimir Presupuesto</a>
          </div>                    
        </div>

        
      </div>           
    </div>

  </div>
  <?php include 'footer.php';?>
</body>
<script type="text/javascript">


function imprSelec(nombre) {
  var ficha = document.getElementById(nombre);
  var ventimp = window.open(' ', 'popimpr');
  ventimp.document.write( ficha.innerHTML );
  ventimp.document.close();
  ventimp.print( );
  ventimp.close();
}


function sumar() {
  var uni = document.getElementById("dato_tres").value;
  var cant = document.getElementById("dato_cuatro").value;
  total = uni *cant;
  document.getElementById("dato_seis").value = total;
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
