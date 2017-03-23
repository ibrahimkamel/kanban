angular.module("kanbanApp").config(function($routeProvider){
		$routeProvider
		.when('/',{
			templateUrl: 'templates/forms.html',
			controller: 'forms'
		}).when('/forms',{
			templateUrl: 'templates/forms.html',
			controller: 'forms'
		}).when("/dashboard",{
			templateUrl: "./templates/dashboard.html",
			controller : "dashboardCtrl"
		}).when('/profile',{
			templateUrl: 'templates/profile.html',
			controller: 'profileCtrl'
		})
	});