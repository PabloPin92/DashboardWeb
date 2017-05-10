var app = angular.module('facturacionApp.configuracion', []);

app.factory('Configuracion', ['$http','$q', function ($http,$q) {
	
	var self = {

		config:{},
		cargar:function(){

			var d = $q.defer();

			$http.get('config.json')
				.then(function(resp){

					self.config = resp;
					d.resolve();
				})
				.catch(function(){
					d.reject();
					console.error("No se pudo cargar el archivo de configuracion :(")
				});

			return d.promise;

		}

	};

	return self;
}]);