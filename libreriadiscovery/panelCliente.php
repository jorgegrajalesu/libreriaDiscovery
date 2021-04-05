<?php
ob_start();
?>
<?php
 session_start();
 //evitar secuestro de sesion al usuario final
 session_regenerate_id(true);
 //validar los campos de sesion
 if(isset($_REQUEST['sesion']) && $_REQUEST['sesion']=="cerrar"){
   //destruir la sesion
   session_destroy();
   header('location: index.php');
 }
 
 //validar que todos los visitantes si tengan un acceso al sitio
 /*if(isset($_SESSION['idcliente'])==false){
   header('location: index.php');
 }*/

 //implementar los modulos que se van a llamar a este sitio
 $modulo=$_REQUEST['modulo'] ?? '';


?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Libreria Discovery</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="admin/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="admin/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="admin/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="admin/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="admin/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
     
    </ul>

   

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
     
        
         
        <a class="nav-link"  href="panelCliente.php?modulo=&sesion=cerrar" title="Cerrar">
             <i class="fas fa-sign-out-alt"></i>
        </a>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="panelCliente.php" class="brand-link">
      <img src="admin/logo.png" alt="Libreria Discovery Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Libreria</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['nombre'];?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Panel Cliente
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
               
              </li>
              
              <li class="nav-item">
                <a href="panelCliente.php?modulo=clienteLibros" class="nav-link <?php echo ($modulo=="clienteLibros")? "active":" ";?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Libros</p>
                </a>
              </li>
            </ul>
          </li>
          

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
       <!--incluir los fragmentos de paginas web-->
      
      <?php
       //mensaje de usuario creado
       if(isset($_REQUEST['mensaje'])){
         ?>
         <div class="alert alert-primary alert-dismissible fade show float-right" role="alert">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             <span class="sr-only">Close</span>
           </button>
          <?php echo $_REQUEST['mensaje']?>
         </div>
         <?php
       }

       

      //incluir modulos o paginas de libros
      if($modulo=="clienteLibros"){
        include_once "clienteLibros.php";

      }

    


      ?>

  <!-- /.content-wrapper -->
  <footer class="main-footer">
  <ul>
				<a href="https://api.whatsapp.com/send?phone=573105188168&text=Hola!!" target="_blank" >Contacto en: <i class="fab fa-whatsapp" width="300"></i> </a>
				</ul>
    <strong>Copyright &copy; 2021 <a href="#">Jorge Grajales</a>.</strong>
    Todos los Derechos Reservados.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="admin/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="admin/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="admin/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="admin/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="admin/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="admin/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="admin/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="admin/plugins/moment/moment.min.js"></script>
<script src="admin/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="admin/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="admin/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="admin/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="admin/dist/js/demo.js"></script>

<!--confirmacion de eliminacion usuarios-->
<script>
 $(document).ready(function(){
   $(".borrar").click(function (e){
     e.preventDefault();
     var eliminar=confirm("Esta seguro de eliminar el usuario?");
     if(eliminar==true){
       var link=$(this).attr("href");
       window.location=link;
     }
   });
 });
</script>


<!--confirmacion de eliminacion libros-->
<script>
 $(document).ready(function(){
   $(".borrarLibro").click(function (e){
     e.preventDefault();
     var eliminar=confirm("Esta seguro de eliminar el libro?");
     if(eliminar==true){
       var link=$(this).attr("href");
       window.location=link;
     }
   });
 });
</script>


<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script>
 $(document).ready(function(){
   setTimeout(function(){
     $(".ocultar").fadeOut(1500);
    },1000);
   });

</script>




</body>
</html>
<?php
ob_end_flush();
?>