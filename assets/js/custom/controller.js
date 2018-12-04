var app = angular.module("app",[]); 

app.controller('compareCtrl',function($scope , DBService){

    $scope.formData = {};
    $scope.mycar1='';
    $scope.mycar2='';
    $scope.car1 = []; 
    $scope.car2 = []; 
    $scope.showData = false;
    $scope.initialize = function(){
        DBService.getCall('/api/getmakemodel').then(function(data){
            $scope.makemodel = data.makemodel;
            $scope.sb_loading = {'display':'none'};
            console.log(data.makemodel);
        })
    }

    $scope.compare = function(){
       $scope.formData.car1= $("#keyword1").val();
       $scope.formData.car2 =  $("#keyword2").val();
       $scope.formData._token=$("#token").val();
        
        if($scope.formData.car1 == $scope.formData.car2){
            alert('Car 2 should be different from car 1');
        }else{

            $scope.showData = false;
            $scope.sb_loading = {
                "display":"block"
            }; 
            console.log($scope.formData);
            DBService.postCall($scope.formData,'/api/fetchCars').then(function(data){
                console.log(data);
                if(data.success){
                    $scope.car1 = data.car1;
                    $scope.car2 = data.car2;
                    $scope.showData = data.success;
                }
                $scope.sb_loading = {'display':'none'};
            });
        }

    }

});


app.service('DBService', function($http, $rootScope){

    this.getCall = function(route){
        var promise = $http({
            method: 'GET',
            url: base_url + route
        })
        .then(function(response) {
            console.log(response);
            if(response.status == 200){
                if(response.data.success){

                    return response.data;
                } else {
                    return response.data;
                }
            }
        });

        return promise;
    }

    this.postCall = function(data, route){
        console.log(data);
        var promise = $http({
            method: 'POST',
            url: base_url + route,
            data: data
        })
        .then(function(response) {
            if(response.status == 200){
                if(response.data.success){
                    return response.data;
                } else {
                    return response.data;
                }
            }
        });

        return promise;
    }

});
