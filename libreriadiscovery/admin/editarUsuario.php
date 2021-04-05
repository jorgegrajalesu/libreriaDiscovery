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
     $email = mysqli_real_escape_string($conn, $_REQUEST['email']??'');
     $clave = md5(mysqli_real_escape_string($conn, $_REQUEST['clave']??''));
     $idusuario = mysqli_real_escape_string($conn, $_REQUEST['idusuario']??'');

     

     //actualizar o editar con lenguaje sql
         $sql = "UPDATE usuarios SET
         nombre='".$nombre."',email='".$email."',clave='".$clave."' 
         WHERE idusuario='".$idusuario."';";
     

     $result =mysqli_query($conn,$sql);

     if($result){
         echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=usuarios&mensaje=Usuario '.$nombre.' Actualizado"/>';
     }else{
         ?>
         
         <div class="alert alert-danger" role="alert">
            Error al actualizar usuario <?php echo mysqli_error($conn); ?>
         </div>
            <?php
        }
    }

    //hay que leer los datos de la tabla
    $idusuario=mysqli_real_escape_string($conn,$_REQUEST['idusuario']??'');
    $sql="SELECT idusuario,nombre,email,clave FROM usuarios WHERE idusuario='".$idusuario."';";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);

  
 

 ?>
<div class="content-wrapper">
        <section class="content-header">
            <div class="content-fluid">
              <div class="row mb-2">    
                 <div class="col-sm-6">
                    <h1>Actualizar Usuarios</h1>
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
                   <form action="panel.php?modulo=editarUsuario" method="post" id="editarUsuario">
                      <div class="form-group">
                       <label for="nombre">Nombre</label>
                       <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Digitar Nombre" value="<?php echo $row['nombre'] ?>">                      
                      </div>

                      <div class="form-group">
                       <label for="email">email</label>
                       <input type="email" name="email" id="email" class="form-control" placeholder="Digitar email" value="<?php echo $row['email'] ?>">                      
                      </div>

                      <div class="form-group">
                       <label for="clave">clave</label>
                       <input type="password" name="clave" id="clave" class="form-control" placeholder="Digitar Password">                      
                      </div>

                      <div class="form-group">
                       <input type="hidden" name="idusuario" value="<?php echo $row['idusuario']?>">
                       <button type="submit" name="guardar" class="btn btn-primary">Actualizar Usuario</button>                      
                       <button type="reset" class="btn btn-danger">Cancelar Usuario</button>                      
                      </div>              
                   
                   
                   </form>
                      
                  </div>
                
                </div>
              </div>         
           
           </div>
        
        </section>

</div>