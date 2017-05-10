var app = angular.module('facturacionApp.Log_out', []);

app.factory('Log_out', ['$http','$q', function ($http,$q) {

		var self = {

		'err'			: false,

		Log_out:function(){

			var d = $q.defer();

			$http.get('php/session/log_out.php')
				.then(function(data){

					//console.log(data);

					//self.err 			= data.data.err;
					//self.mensaje	= data.data.mensaje;
   
   					//console.log(data.data.usuarios_online)

					return d.resolve();

				})

			return d.promise;

		}

	};

	return self;
}]);