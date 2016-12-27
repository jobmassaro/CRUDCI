var app = angular.module('myApp',['ui.bootstrap']);


app.controller('FormController', function($scope, $http){

		//var baseUrl = 'index.php/';
		$scope.name = "";
		$scope.city = "";
		$scope.message = "";


		$scope.submitForm = function()
		{


		$http.post('add',{"name": $scope.name, "city": $scope.city}).success(function(data){
				var scope = angular.element(document.getElementById("table")).scope();
				scope.rows.push({name: $scope.name, city: $scope.city});
				$scope.rows = scope;

				alertify.notify(data.message, data.status,5 ,function(){
					console.log(data.message);
		});
			
			
			

			});
		}









});	



app.controller('TableViewController', function($scope, $http)
{



	getHead();

	function getHead()
	{
		$http.get('listAll').success(function(data){
			$scope.rows = data;
		})
	}




	

		$scope.delete = function(del)
		{
			$http.post('delete', {id: del.id}).success(function(info){
				getHead();
			})
		}

});