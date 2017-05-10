var app = angular.module('facturacionApp.clientesCtrl', []);

//Controlador de Clientes

app.controller('clientesCtrl', ['$scope', '$routeParams', 'Clientes', function ($scope, $routeParams,Clientes) {
	
	var pag = $routeParams.pag;



	$scope.activar('mClientes','','Clientes','Listado');
	$scope.clientes = {};

	$scope.moverA = function(pag){

		Clientes.cargarPagina(pag).then(function(){
		$scope.clientes = Clientes;

		});
	};

	$scope.moverA(pag);

}]);