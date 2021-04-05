<?php
ob_start();
?>
<?php

 //verificar que el usuario tenga la sesion activa
 //obligar al visitante que se registre
 if(isset($_SESSION['idusuario'])==false){
     header('location: index.php');
 }
 
 if(isset($_REQUEST['guardar'])){
     require_once('conexion.php');
     $conn = mysqli_connect($host, $user, $pwd, $db);

     //declarar variables para tomar los datos en los input

     $nombre = mysqli_real_escape_string($conn, $_REQUEST['nombre']??'');
     $isbn = mysqli_real_escape_string($conn, $_REQUEST['isbn']??'');
     $precio = mysqli_real_escape_string($conn, $_REQUEST['precio']??'');
     $existencia = mysqli_real_escape_string($conn, $_REQUEST['existencia']??'');
     $descripcion = mysqli_real_escape_string($conn, $_REQUEST['descripcion']??'');
     //verificar que no se repita un libro con el mismo nombre o isbn
     $veriuser ="SELECT * FROM libro WHERE nombre='".$nombre."' OR isbn='".$isbn."';";
     $veriresult=$conn->query($veriuser);
     $veryrow=$veriresult->num_rows;

     if($nombre !="" && $isbn !="" && $precio!="" && $existencia!="" && $veryrow==null){
         $sql = "INSERT INTO libro
         (nombre,isbn,precio,existencia,descripcion) VALUES
         ('".$nombre."','".$isbn."','".$precio."','".$existencia."','".$descripcion."');";
     

     $result =mysqli_query($conn,$sql);

     if($result){
         echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=libros&mensaje=Libro Creado"/>';
     }else{
         ?>
         
         <div class="alert alert-danger" role="alert">
            Error al crear libro <?php echo mysqli_error($conn); ?>
         </div>
            <?php
        }

    }
  }
 

 ?>
<div class="content-wrapper">
        <section class="content-header">
            <div class="content-fluid">
              <div class="row mb-2">    
                 <div class="col-sm-6">
                    <h1>Crear Libros</h1>
                 </div>
              </div>
            </div>        
        </section>

        <!--contenido o content-->
        <section class="content">
           <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                   <form action="panel.php?modulo=crearLibro" method="post" id="crearLibro">
                      <div class="form-group">
                       <label for="nombre">Nombre</label>
                       <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Digitar Nombre">                      
                      </div>

                      <div class="form-group">
                       <label for="isbn">isbn</label>
                       <input type="text" name="isbn" id="isbn" class="form-control" placeholder="Digitar isbn">                      
                      </div>

                      <div class="form-group">
                       <label for="precio">precio</label>
                       <input type="text" name="precio" id="precio" class="form-control" placeholder="Digitar precio">                      
                      </div>

                      <div class="form-group">
                       <label for="existencia">existencia</label>
                       <input type="text" name="existencia" id="existencia" class="form-control" placeholder="Digitar existencia">                      
                      </div>

                      <div class="form-group">
                       <label for="descripcion">descripcion</label>
                       <textarea name="descripcion" id="descripcion" class="form-control" cols="30" rows="10" placeholder="Descripcion"></textarea>                      
                      </div>

                      <div class="form-group">
                       <button type="submit" name="guardar" class="btn btn-primary">Crear Libro</button>                      
                       <button type="reset" class="btn btn-danger">Cancelar Libro</button>                      
                      </div>              
                   
                   
                   </form>
                      
                  </div>
                
                </div>
              </div>         
           
           </div>
        
        </section>

</div>
<?php
ob_end_flush();
?>