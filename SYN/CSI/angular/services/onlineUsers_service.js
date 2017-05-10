var app = angular.module('facturacionApp.OnlineUsers', []);

app.factory('OnlineUsers', ['$http','$q', function ($http,$q) {

		var self = {

		'err'			: false,
		'online_users'	: [],

		loadusers:function(){

			var d = $q.defer();

			$http.get('php/online_users/online_users.php')
				.then(function(data){

					//console.log(data);

					self.err 			= data.data.err;
					self.online_users	= data.data.usuarios_online;
   
   					//console.log(data.data.usuarios_online)

					return d.resolve();

				})

			return d.promise;

		}

	};

	return self;
}]);