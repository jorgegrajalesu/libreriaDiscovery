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
     $email = mysqli_real_escape_string($conn, $_REQUEST['email']??'');
     $clave = md5(mysqli_real_escape_string($conn, $_REQUEST['clave']??''));
     //verificar que no se repita un usuario con el mismo correo
     $veriuser ="SELECT * FROM usuarios WHERE email='".$email."';";
     $veriresult=$conn->query($veriuser);
     $veryrow=$veriresult->num_rows;

     if($nombre !="" && $email !="" && $veryrow==null){
         $sql = "INSERT INTO usuarios
         (nombre,email,clave) VALUES
         ('".$nombre."','".$email."','".$clave."');";
     

     $result =mysqli_query($conn,$sql);

     if($result){
         echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=usuarios&mensaje=Usuario Creado"/>';
     }else{
         ?>
         
         <div class="alert alert-danger" role="alert">
            Error al crear usuario <?php echo mysqli_error($conn); ?>
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
                    <h1>Crear Usuarios</h1>
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
                   <form action="panel.php?modulo=crearUsuario" method="post" id="crearUsuario">
                      <div class="form-group">
                       <label for="nombre">Nombre</label>
                       <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Digitar Nombre">                      
                      </div>

                      <div class="form-group">
                       <label for="email">email</label>
                       <input type="email" name="email" id="email" class="form-control" placeholder="Digitar email">                      
                      </div>

                      <div class="form-group">
                       <label for="clave">clave</label>
                       <input type="password" name="clave" id="clave" class="form-control" placeholder="Digitar Password">                      
                      </div>

                      <div class="form-group">
                       <button type="submit" name="guardar" class="btn btn-primary">Crear Usuario</button>                      
                       <button type="reset" class="btn btn-danger">Cancelar Usuario</button>                      
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