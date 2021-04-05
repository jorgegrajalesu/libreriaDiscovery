<?php
ob_start();
?>
<?php
 //conexión a la base de datos
 include_once 'admin/conexion.php';
 $conn = mysqli_connect($host, $user, $pwd, $db);

 //verificar que el usuario tenga la sesion activa
 //obligar al visitante que se registre
 if(isset($_SESSION['idcliente'])==false){
     header('location: index.php');
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
                                          
                         </tr>                        
                        </thead>
                        <tbody>
                        <?php
                        //conectar a la base de datos
                         include_once "admin/conexion.php";
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