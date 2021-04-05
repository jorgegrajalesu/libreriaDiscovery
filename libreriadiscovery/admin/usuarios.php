<?php
ob_start();
?>

<?php
 //conexión a la base de datos
 include_once 'conexion.php';
 $conn = mysqli_connect($host, $user, $pwd, $db);

 //verificar que el usuario tenga la sesion activa
 //obligar al visitante que se registre
 if(isset($_SESSION['idusuario'])==false){
     header('location: index.php');
 }

 //borrar usuario
 if(isset($_REQUEST['idBorrar'])){
    $idusuario = mysqli_real_escape_string($conn,$_REQUEST['idBorrar']??'');
    //query o instruccion para eliminar con lenguaje sql
    $sql ="DELETE FROM usuarios WHERE idusuario='".$idusuario."';";
    $result=mysqli_query($conn,$sql);

    if($result){
       ?>
       
       <div class="alert alert-success ocultar float-right" role="alert">
          Usuario Eliminado!!
       </div>
       <?php       
    }else{
       ?>
       
       <div class="alert alert-danger float-right" role="alert">
          Error en eliminar usuario!! <?php echo $mysqli_error($conn); ?>
       </div>
       <?php
      }
   }

   ?>
<div class="content-wrapper">
        <section class="content-header">
            <div class="content-fluid">
              <div class="row mb-2">    
                 <div class="col-sm-6">
                    <h1>Usuarios</h1>
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
                      <!--crear la tabla para el nombre y email usuario registrado-->
                      <table id="" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Opciones
                        <a title="Crear Usuario" href="panel.php?modulo=crearUsuario"><i class="fas fa-user-plus"></i></a>
                                            
                        </th>                        
                         </tr>                        
                        </thead>
                        <tbody>
                        <?php
                        //conectar a la base de datos
                         include_once "conexion.php";
                         $conn=mysqli_connect($host, $user, $pwd, $db);

                         //consulta o query a la tabla usuarios
                         $sql="SELECT * FROM usuarios;";
                         $result=mysqli_query($conn,$sql);

                         //aplicar un bucle para mostrar los datos de la tabla usuarios

                         while($row = mysqli_fetch_assoc($result)){
                             ?>

                             <tr>
                             <td><?php echo $row['nombre'] ?></td>
                             <td><?php echo $row['email'] ?></td>
                             <td>
                              <a href="panel.php?modulo=editarUsuario&idusuario=<?php echo $row['idusuario'] ?>" style="margin-right: 10px"><i class="fa fa-user-edit" title="Editar Usuario"></i></a>
                              <a href="panel.php?modulo=usuarios&idBorrar=<?php echo $row['idusuario'] ?>" class="fas fa-trash-alt borrar" title="Eliminar Usuario"></a>
                             </td>
                             
                             </tr>
                             <?php
                         
                        }


                        ?>
                       </tbody>
                      </table>
                  </div>
                
                </div>


              </div>
           
           
           </div>
        
        </section>

</div>
<?php
ob_end_flush();
?>