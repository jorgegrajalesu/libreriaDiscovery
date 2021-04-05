<?php
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login Libreria Discovery</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="admin/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="admin/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
             <b>Libreria </b>Discovery
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Iniciar Sesion</p>
       <?php
         //condicional para el boton login
         if(isset($_REQUEST['login'])){
           //iniciar sesion
           session_start();
           //declarar variables de acuerdo a la propiedad name de los input
           $email = $_REQUEST['email'] ?? '';
           $clave = $_REQUEST['clave'] ?? '';
           //encriptar con md5
           $clave=md5($clave);

           //llamar la conexion a la base de datos
           require_once ('admin/conexion.php');
           $conn =mysqli_connect($host, $user, $pwd, $db);
           //consulta a la tabla clientes
           $sql ="SELECT * FROM clientes WHERE email='".$email."' AND clave='".$clave."';";
           $result = mysqli_query($conn,$sql);
           //utilizar un array asociativo
           $row = mysqli_fetch_assoc($result);

           //validar que los datos en la tabla clientes sean los correctos para ingresar
           if($row){
             //variables de sesion
             $_SESSION['idcliente']=$row['idcliente'];
             $_SESSION['nombre']=$row['nombre'];
             $_SESSION['email']=$row['email'];

             //ir a la pagina del panel
             header('location: panelCliente.php');
             exit;

           }else{
             ?>             
              
              <div class="alert alert-danger" role="alert">               
                <strong>Error en Login! <img src="admin/error.png" alt="Error en Login" width="100"></strong> 
              </div>
              
             <?php
           }
         }
       ?>

      <form  method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="clave" class="form-control" placeholder="Clave">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">
          
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="login" class="btn btn-primary btn-block">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
       
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Acceder con Google+
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.html">Olviste la contraseña?</a>
      </p>
      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="admin/dist/js/adminlte.min.js"></script>

</body>
</html>
<?php
ob_end_flush();
?>