<?php
  session_start();
  //Mata el login
  unset($_SESSION['user']);
?>

<!DOCTYPE html>
<html ng-app="loginApp" ng-controller="mainCtrl">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard Console | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="AdminLTE.min.css">
  <!-- Sweet Alert -->
  <link rel="stylesheet" href="sweetalert2/sweetalert2.min.css">
  <script src="sweetalert2/sweetalert2.min.js"></script>

  <script src="angular/lib/angular.min.js"></script>
  <script src="angular/app.js"></script>
  <script src="angular/services/login_service.js"></script>

<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>Dashboard</b> SYN</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
  <ul class="pagination pagination-sm no-margin center-block">
                <img src="img/logo.jpg" class="center-block">
              </ul>
    <p class="login-box-msg"></p>

    <form name="forma" ng-submit="ingresar (datos)">
      <div class="form-group has-feedback">
        <input type="text" 
        		class="form-control" 
        		placeholder="Usuario"
        		name="usuario" 
        		required="required"
        		ng-model="datos.usuario">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" 
        		class="form-control" 
        		placeholder="Contraseña"
        		name="contrasena" 
        		required="required"
        		ng-model="datos.contrasena">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        
        <div class="col-xs-12">
          <button type="submit" 
          		  class="btn btn-primary btn-block btn-flat"
          		  ng-disabled="forma.$invalid || cargando"> Ingresar 
          </button>
        </div>
      </div>

  <div class="row" ng-show="invalido || loginAlertMessage">
  	<div class="col-md-12 text-center">
  	<br>
  		<div class="alert alert-danger">
  			  {{mensaje}}
  		</div>
  	</div>
  </div>

    </form>


  </div>
  <!-- /.login-box-body -->
  <div class="box-footer text-center">
              	<strong>Copyright © 2017 DirtyFeet Studios©</strong> 
              	<br>
              	All rights reserved.
              
   </div>

   
</div>
<!-- /.login-box -->

</body>

</html>
