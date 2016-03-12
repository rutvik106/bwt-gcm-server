angular
.module("bwt.services",[])
.factory('access',function(){

	var obj={};

	this.allow=false;

	obj.checkLogin=function(userName,password){

		if(userName=="admin" && password=="admin"){
			this.allow=true;
			return true;
		}
		else{
			return false;
		}

	}

	obj.isAllowed=function(){
		return this.allow;
	}

	return obj;

});