var app = angular.module('facturacionApp.tickets', []);

app.factory('Tickets', ['$http','$q', function ($http,$q) {

	var self = {

		'cargando'		: false, 
		'err'			: false,
		'conteo'		: 0,
		'tickets'		: [],
		'pag_actual'	: 1,
		'pag_siguiente'	: 1,
		'pag_anterior'  : 1,
		'total_paginas' : 1,
		'paginas'	    : [],

		cargarPagina: function(pag){

			var d = $q.defer();

			$http.get('php/tickets/get.tickets.php?pag=' + pag)
				.then(function(data){

					//console.log(data);

					self.err = data.data.err;
					self.conteo	= data.data.conteo;
					self.tickets =	data.data.tickets;	
					self.pag_actual = data.data.pag_actual;	
					self.pag_siguiente = data.data.pag_siguiente;	
					self.pag_anterior = data.data.pag_anterior;
					self.total_paginas = data.data.total_paginas;
					self.paginas = data.data.paginas;	   

					//console.log(data.data.tickets)

					return d.resolve();

				})

			return d.promise;

		}

	};

	return self;

}]);