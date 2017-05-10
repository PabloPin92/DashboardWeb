var app = angular.module('facturacionApp.loggedUser', []);

app.factory('LoggedUser', ['$http','$q', function ($http,$q) {

		var self = {

		'err'			: false,
		'usuario'		: '',
		'datos_usuario'	: [],

		loaduser:function(){

			var d = $q.defer();

			$http.get('php/session/sesion_user.php')
				.then(function(data){

					//console.log(data);

					self.err 			= data.data.err;
					self.usuario 			= data.data.usuario;
					self.datos_usuario	= data.data.datos_usuario;
   
   					//console.log(data.data.tickets)

					return d.resolve();

				})

			return d.promise;

		}

	};

	return self;
}]);