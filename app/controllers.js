angular
.module("bwt.controllers",[])
.controller("main-controller",["$scope","$location",function($scope,$location){

	vfxAnimInit();

	$scope.showOffers=function(){
			
			$location.path("/view-offers");
	};

}])

.controller("offers-controller",["$scope","$location","$http",function($scope,$location,$http){


	vfxAnimRootShrinkIn();

	$http.get('app/templates/GCM/get_all_offers.php')
       .then(function(res){
          $scope.offers = res.data;                
        });

	$scope.goBack=function(){
			$location.path("/view-main");
	};

	$scope.deleteOffer=function(id){
			$http.get('app/templates/GCM/delete_offer.php?id='+id)
       			.then(function(res){
          		$scope.offers = res.data;                
        	});
	};



}])

.controller("login-controller",["$scope","$location","access",function($scope,$location,access){

	vfxAnimInit();

	$scope.login=function(){
		if(access.checkLogin($scope.user.userName,$scope.user.password)){
			$location.path("/view-main");
		}
		else{
			vfxAnimLoginError();
		}
	};

	

}]);