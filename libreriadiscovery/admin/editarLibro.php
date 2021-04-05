<?php
ob_start();
?>
<?php
  require_once('conexion.php');
  $conn = mysqli_connect($host, $user, $pwd, $db);
 //verificar que el usuario tenga la sesion activa
 //obligar al visitante que se registre
 if(isset($_SESSION['idusuario'])==false){
     header('location: index.php');
 }
 
 if(isset($_REQUEST['guardar'])){
     

     //declarar variables para tomar los datos en los input

     $nombre = mysqli_real_escape_string($conn, $_REQUEST['nombre']??'');
     $isbn = mysqli_real_escape_string($conn, $_REQUEST['isbn']??'');
     $precio = mysqli_real_escape_string($conn, $_REQUEST['precio']??'');
     $existencia = mysqli_real_escape_string($conn, $_REQUEST['existencia']??'');
     $descripcion = mysqli_real_escape_string($conn, $_REQUEST['descripcion']??'');
     $idlibro = mysqli_real_escape_string($conn, $_REQUEST['idlibro']??'');

     

     //actualizar o editar con lenguaje sql
         $sql = "UPDATE libro SET
         nombre='".$nombre."',isbn='".$isbn."',precio='".$precio."',
         existencia='".$existencia."',descripcion='".$descripcion."' 
         WHERE idlibro='".$idlibro."';";
     

     $result =mysqli_query($conn,$sql);

     if($result){
         echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=libros&mensaje=Libro '.$nombre.' Actualizado"/>';
     }else{
         ?>
         
         <div class="alert alert-danger" role="alert">
            Error al actualizar libro <?php echo mysqli_error($conn); ?>
         </div>
            <?php
        }
    }

    //hay que leer los datos de la tabla
    $idlibro=mysqli_real_escape_string($conn,$_REQUEST['idlibro']??'');
    $sql="SELECT * FROM libro WHERE idlibro='".$idlibro."';";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);

  
 

 ?>
<div class="content-wrapper">
        <section class="content-header">
            <div class="content-fluid">
              <div class="row mb-2">    
                 <div class="col-sm-6">
                    <h1>Actualizar libros</h1>
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
                   <form action="panel.php?modulo=editarLibro" method="post" id="editarLibro">
                      <div class="form-group">
                       <label for="nombre">Nombre</label>
                       <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Digitar Nombre" value="<?php echo $row['nombre'] ?>">                      
                      </div>

                      <div class="form-group">
                       <label for="isbn">isbn</label>
                       <input type="text" name="isbn" id="isbn" class="form-control" placeholder="Digitar isbn" value="<?php echo $row['isbn'] ?>">                      
                      </div>

                      <div class="form-group">
                       <label for="precio">precio</label>
                       <input type="text" name="precio" id="precio" class="form-control" placeholder="Digitar precio" value="<?php echo $row['precio'] ?>">                      
                      </div>

                      <div class="form-group">
                       <label for="existencia">existencia</label>
                       <input type="text" name="existencia" id="existencia" class="form-control" placeholder="Digitar existencia" value="<?php echo $row['existencia'] ?>">                      
                      </div>

                      <div class="form-group">
                       <label for="descripcion">descripcion</label>
                       <textarea name="descripcion" id="descripcion" class="form-control" cols="30" rows="10" placeholder="Digitar descripcion"><?php echo $row['descripcion'] ?></textarea>                      
                      </div>

                      <div class="form-group">
                       <input type="hidden" name="idlibro" value="<?php echo $row['idlibro']?>">
                       <button type="submit" name="guardar" class="btn btn-primary">Actualizar Libro</button>                      
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