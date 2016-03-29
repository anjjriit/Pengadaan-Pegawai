var appCPNS = angular.module('CPNSRecords', [], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    })
	.constant('API_URL', 'http://localhost:8000/api/v1/cpns/')
    .config(function($locationProvider){
        $locationProvider.html5Mode({
            enabled: true,
            requireBase: false
        })
    });