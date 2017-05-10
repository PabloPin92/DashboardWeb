var app = angular.module('facturacionApp.refreshCtrl',[])
.controller('refreshCtrl',function($scope,$interval){
var c=0;
$scope.message=c;
$interval(function(){

$scope.message=c;
c++;
},10000);
});