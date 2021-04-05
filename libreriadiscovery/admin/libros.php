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

 //borrar libro
 if(isset($_REQUEST['idBorrar'])){
    $idlibro = mysqli_real_escape_string($conn,$_REQUEST['idBorrar']??'');
    //query o instruccion para eliminar con lenguaje sql
    $sql ="DELETE FROM libro WHERE idlibro='".$idlibro."';";
    $result=mysqli_query($conn,$sql);

    if($result){
       ?>
       
       <div class="alert alert-success ocultar float-right" role="alert">
         Libro Eliminado!!
       </div>
       <?php       
    }else{
       ?>
       
       <div class="alert alert-danger float-right" role="alert">
          Error en eliminar libro!! <?php echo $mysqli_error($conn); ?>
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
                    <h1>Libros</h1>
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
                        <th>Isbn</th>                     
                        <th>Precio</th>
                        <th>Existencia</th>
                        <th>Descripcion</th>
                        <th>Opciones
                        <a title="Crear Libro" href="panel.php?modulo=crearLibro"><i class="fas fa-book-medical"></i></a>
                                            
                        </th>                        
                         </tr>                        
                        </thead>
                        <tbody>
                        <?php
                        //conectar a la base de datos
                         include_once "conexion.php";
                         $conn=mysqli_connect($host, $user, $pwd, $db);

                         //consulta o query a la tabla libro
                         $sql="SELECT * FROM libro;";
                         $result=mysqli_query($conn,$sql);

                         //aplicar un bucle para mostrar los datos de la tabla libro

                         while($row = mysqli_fetch_assoc($result)){
                             ?>

                             <tr>
                             <td><?php echo $row['nombre'] ?></td>
                             <td><?php echo $row['isbn'] ?></td>
                             <td><?php echo $row['precio'] ?></td>
                             <td><?php echo $row['existencia'] ?></td>
                             <td><?php echo $row['descripcion'] ?></td>
                             <td>
                              <a href="panel.php?modulo=editarLibro&idlibro=<?php echo $row['idlibro'] ?>" style="margin-right: 10px"><i class="fa fa-book" title="Editar Libro"></i></a>
                              <a href="panel.php?modulo=libros&idBorrar=<?php echo $row['idlibro'] ?>" class="fas fa-trash-alt borrarLibro" title="Eliminar Libro"></a>
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