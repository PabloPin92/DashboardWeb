var app = angular.module('facturacionApp.mensajes', []);

app.factory('Mensajes', ['$http','$q', function ($http,$q) {
	
	var self = {

		mensajes: [{

			img:'dist/img/user2-160x160.jpg',
			nombre: "Pablo Pin",
			mensaje: 'Bienvenido a nuestro servicio de facturación',
			fecha: '7-marzo'
			},
			{
			img:'dist/img/user2-160x160.jpg',
			nombre: "Mishell Abad",
			mensaje: 'bla bla bla bla bla bla bla bla bla bla bla bla',
			fecha: '8-marzo'
			},
			{
			img:'dist/img/user2-160x160.jpg',
			nombre: "Paola Carrasco",
			mensaje: 'bla bla bla bla bla bla bla bla bla bla bla bla',
			fecha: '9-marzo'			
		}]

	};

	return self;
}]);