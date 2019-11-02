(function(){
    var app = angular.module('tutapos', [ ]);

    app.controller("SearchItemCtrl", [ '$scope', '$http', function($scope, $http) {
        $scope.items = [ ];
        $http.get(site_url+'/api/recitem').success(function(data) {
            $scope.items = data;
        });

        $scope.receivingtemp = [ ];
        $scope.newreceivingtemp = { };
        $http.get(site_url+'/api/receivingtemp').success(function(data, status, headers, config) {
            $scope.receivingtemp = data;
        });
        $scope.addReceivingTemp = function(item,newreceivingtemp) {
            $http.post(site_url+'/api/receivingtemp', { item_id: item.id, cost_price: item.cost_price, total_cost: item.cost_price, type: item.type }).
            success(function(data, status, headers, config) {
                $scope.receivingtemp.push(data);
                    $http.get(site_url+'/api/receivingtemp').success(function(data) {
                    $scope.receivingtemp = data;
                    });
            });
        }
        $scope.updateReceivingTemp = function(newreceivingtemp) {
            $http.put(site_url+'/api/receivingtemp/' + newreceivingtemp.id, { quantity: newreceivingtemp.quantity, total_cost: newreceivingtemp.item.cost_price * newreceivingtemp.quantity }).
            success(function(data, status, headers, config) {
                });
        }
        $scope.removeReceivingTemp = function(id) {
            $http.delete(site_url+'/api/receivingtemp/' + id).
            success(function(data, status, headers, config) {
                $http.get(site_url+'/api/receivingtemp').success(function(data) {
                        $scope.receivingtemp = data;
                        });
                });
        }     
        $scope.sum = function(list) {
            var total=0;
            angular.forEach(list , function(newreceivingtemp){
                total+= parseFloat(newreceivingtemp.cost_price * newreceivingtemp.quantity);
            });
            return total;
        }

    }]);
})();