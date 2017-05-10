var app = angular.module('facturacionApp.ticketsCtrl', []);

//Controlador de Clientes

app.controller('ticketsCtrl', ['$scope', '$routeParams', 'Tickets', function ($scope, $routeParams,Tickets) {
	
	var pag = $routeParams.pag;



	$scope.activar('mTickets','','Tickets','Listado');
	$scope.tickets = {};

	$scope.moverA = function(pag){

		Tickets.cargarPagina(pag).then(function(){
		$scope.tickets = Tickets.tickets;

		//console.log(Tickets.tickets);

		});
	};

	$scope.moverA(pag);

}]);