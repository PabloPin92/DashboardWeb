var app = angular.module('loginApp', ['login.loginService']);

app.controller('mainCtrl', ['$scope','$timeout','LoginService', function ($scope, $timeout, LoginService) {

	$scope.invalido = false;
	$scope.cargando = false;
	$scope.mensaje = "";

	$scope.loginAlertMessage = false;

	$scope.datos = {};

	$scope.ingresar = function (datos){

		if (datos.usuario.length < 3) {
			$scope.invalido = true;
			$scope.mensaje = "Usuario invalido";
			return;

		}

		$scope.invalido = false;
		$scope.cargando = true;

		LoginService.login(datos).then (function (data){

			if (data.data.err) {
				$scope.invalido = true;
				$scope.cargando = false;
				$scope.loginAlertMessage = true;
				$scope.mensaje = data.data.mensaje;
				setTimeout(function() {
					$scope.loginAlertMessage = false;
					$scope.$apply();
				}, 2000);
				//console.log(data.data.mensaje);


			}else {
				//console.log(data.data.mensaje);
				//console.log(data.data);
				window.location = data.data.url;

			}

		});

		//console.log(datos);

	}


}]);
