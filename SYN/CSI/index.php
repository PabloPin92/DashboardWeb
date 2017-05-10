<?php

session_start();

if (!isset($_SESSION['user'])){
      echo "Acceso Denegado";
      // echo $_SESSION['user'];
      // echo json_encode( $_SESSION['user'] );
  die;
}

if ($_SESSION['user'] <> 'csi'){
      echo "Acceso Denegado";
      // echo $_SESSION['user'];
      // echo json_encode( $_SESSION['user'] );
  die;
}

// echo $_SESSION['user'];
// echo json_encode( $_SESSION['user'] );

?>


<!DOCTYPE html>
<html ng-app="facturacionApp" ng-controller="mainCtrl">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{config.data.aplicativo}} </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"> -->
  <!-- Ionicons -->
  <link rel="stylesheet" href="ionicons/css/ionicons.min.css">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.css">
  <!-- Color style -->
  <link rel="stylesheet" href="dist/css/skins/skin-red.min.css">
    <!-- Sweet Alert -->
  <link rel="stylesheet" href="sweetalert2/sweetalert2.min.css">
  <script src="sweetalert2/sweetalert2.min.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Estilos personalizados -->

  <link rel="stylesheet" href="dist/css/animate.css">
  <link rel="stylesheet" href="dist/css/main.css">


  <!-- Importacion de AngularJS -->

    <script src="angular/lib/angular.min.js"></script>
    <script src="angular/lib/angular-route.min.js"></script>

  
  <!-- Controladores de AngularJS -->

    <script src="angular/app.js"></script>
    <script src="angular/controladores/clientesCtrl.js"></script>
    <script src="angular/controladores/dashboardCtrl.js"></script>
    <script src="angular/controladores/ticketsCtrl.js"></script>
<!--     <script src="angular/controladores/refreshCtrl.js"></script> -->

  <!-- Servicios -->

    <script src="angular/services/config_services.js"></script>
    <script src="angular/services/sms_services.js"></script>
    <script src="angular/services/notification_services.js"></script>
    <script src="angular/services/clientes_services.js"></script>
    <script src="angular/services/tickets_services.js"></script>
    <script src="angular/services/loggeduser_service.js"></script>
    <script src="angular/services/onlineUsers_service.js"></script>
    <script src="angular/services/logout_service.js"></script>

<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

</head>

<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>{{ config.data.iniciales[0] }}</b>{{ config.data.iniciales | quitarletra }}</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>{{ config.data.aplicativo }}</b>{{ config.data.iniciales }}</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <!-- <li class="dropdown messages-menu"
          ng-include="'template/mensajes.html'">
            
          </li> -->
          <!-- /.messages-menu -->

          <!-- Notifications Menu -->
<!--           <li class="dropdown notifications-menu"
          ng-include="'template/notificaciones.html'">

          </li> -->
          <!-- User Account Menu -->
          <li class="dropdown user user-menu"
          ng-include="'template/usuario.html'">
            
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar"
  ng-include="'template/sidebarmenu.html'">

    
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

      

      <h1>
        {{titulo}}
        <small>{{subtitulo}}</small>
      </h1>

    </section>

    <!-- Main content -->
    <section class="content" ng-view="">



      <!-- Your Page Content Here -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Versión: {{config.data.version}}
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; {{config.data.anio}} <a href="" ng-click="show_logo()">{{config.data.empresa}}</a>.</strong> Todos los derechos reservados.
  </footer>

</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
