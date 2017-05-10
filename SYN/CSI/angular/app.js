{
	var app = angular.module('facturacionApp', [
	'ngRoute',
	'facturacionApp.configuracion',
	'facturacionApp.mensajes',
	'facturacionApp.notificaciones',
	'facturacionApp.clientes',
	'facturacionApp.clientesCtrl',
	'facturacionApp.dashboardCtrl',
	'facturacionApp.tickets', 
	'facturacionApp.ticketsCtrl',
	'facturacionApp.loggedUser',
	'facturacionApp.OnlineUsers',
	'facturacionApp.Log_out']);

app.controller('mainCtrl', ['$scope', 'Configuracion','Mensajes','Notificaciones','LoggedUser', 'OnlineUsers',
	'Log_out','$interval',
	function ($scope, Configuracion,Mensajes,Notificaciones,LoggedUser,OnlineUsers,Log_out,$interval) {
	
	$scope.config = {};

	$scope.notificaciones = Notificaciones.notificaciones;
	var c=0;

	$scope.titulo ="";
	$scope.subtitulo ="";

	$scope.usuario =  {};
	$scope.online_users =  {};
	$scope.tickets_asignados = {};


	Configuracion.cargar().then( function(){
		$scope.config = Configuracion.config;
		//console.log($scope.config);
	});

	LoggedUser.loaduser().then( function(){
		$scope.usuario = LoggedUser.datos_usuario["0"];
		//console.log($scope.usuario);
	});

		OnlineUsers.loadusers().then( function(){
		$scope.online_users = OnlineUsers.online_users;

		//console.log($scope.online_users.length);
		//console.log($scope.online_users);
	});


	// $scope.mensajes = Mensajes.mensajes;
	$interval(function(){
		OnlineUsers.loadusers().then( function(){
		$scope.online_users = OnlineUsers.online_users;

	});
	},30000);

	//Funciones Globales

	$scope.activar = function(menu, submenu,titulo, subtitulo){
		
		$scope.titulo = titulo;
		$scope.subtitulo =subtitulo;

		$scope.mDashboard = "";
		$scope.mClientes = "";
		$scope.mTickets = "";

		$scope[menu]='active';
	};


	$scope.log_out_alert = function(){

		swal({
  			title: '¿Estas segur@?',
  			type: 'error',
  			//text: "You won't be able to revert this!",
  			showCancelButton: true,
  			confirmButtonColor: '#3085d6',
  			cancelButtonColor: '#d33',
  			confirmButtonText: '<i class="fa fa-check"></i> Si',
  			cancelButtonText: '<i class="fa fa-ban"></i> No',
		}).then(function () {
			swal({
  				title: 'Saliendo...',
  				imageUrl: 'dist/img/dirtyfeetlogo.jpg',
  				timer: 2000
		}).then(
  			function () {
  				Log_out.Log_out().then( function(){
				window.location = "../../public/";
				});
  		
 			 },
  // handling the promise rejection
  			function (dismiss) {
  			  if (dismiss === 'timer') {
			
			  	Log_out.Log_out().then( function(){
				window.location = "../../public/";
				
				});

    			}
  			}
		)

})

	};


	$scope.show_logo = function(){
		swal({
  title: 'DirtyFeet Studios©',
  text: 'Desarrollado por: Pablo Pin',
  imageUrl: 'dist/img/dirtyfeetlogo.jpg'
})
	};


}]);

// Rutas

app.config(['$routeProvider', function($routeProvider){

	$routeProvider
		.when('/', {
			templateUrl: 'dashboard/dashboard.html',
			controller: 'dashboardCtrl'
		}).when('/clientes/:pag', {
			templateUrl: 'clientes/clientes.html',
			controller: 'clientesCtrl'
		}).when('/tickets/:pag', {
			templateUrl: 'tickets/tickets.html',
			controller: 'ticketsCtrl'	
		}).otherwise({ 
			redirectTo: '/' 
		})

}]);

// Directivas



// Filtros

app.filter('quitarletra', function(){

	return function(palabra){
		if( palabra ){
			if (palabra.length > 1) {
				return palabra.substr(1)
			}
			else {
				return palabra;
			}
		}
	}


})
.filter('mensajecorto', function(){

	return function(mensaje){
		if( mensaje ){
			if (mensaje.length > 38) {
				return mensaje.substr(0,38) + "...";
			}
			else {
				return mensaje;
			}
		}
	}

})
}