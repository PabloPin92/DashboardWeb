var app = angular.module('login.loginService',[]);

app.factory('LoginService', ['$http', '$q', function ($http , $q) {
	
	var self = {

		login: function(datos){

			var d = $q.defer();
			//console.log(datos);

			$http.post('php/login/post.verificar.php', datos)
					.then(function(data){
						//console.log(data);
						d.resolve(data);
					});

			return d.promise;

		}

	};


	return self;

}])