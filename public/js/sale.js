(function(){
    var app = angular.module('flexiblepos', [ ]);

    app.controller("SearchItemCtrl", [ '$scope', '$http', function($scope, $http) {
        $scope.items = [ ];

        $http.get(site_url+'/api/item').success(function(data) {
            $scope.items = data;
        });

        $scope.recitems = [ ];
        $http.get(site_url+'/api/recitem').success(function(data) {
            $scope.recitems = data;
        });

        $scope.saletemp = [ ];
        $scope.newsaletemp = { };
        $http.get(site_url+'/api/saletemp').success(function(data, status, headers, config) {
            $scope.saletemp = data;

        });
        $scope.addSaleTemp = function(item, newsaletemp) {
            $http.post(site_url+'/api/saletemp', { item_id: item.id, cost_price: item.cost_price, selling_price: item.selling_price }).
            success(function(data, status, headers, config) {
                $scope.saletemp.push(data);
                    $http.get(site_url+'/api/saletemp').success(function(data) {
                    $scope.saletemp = data;
                    });
            });
        }

        $scope.updateSaleTemp = function(newsaletemp) {
            
            $http.put(site_url+'/api/saletemp/' + newsaletemp.id, { quantity: newsaletemp.quantity, total_cost: newsaletemp.item.cost_price * newsaletemp.quantity,
                total_selling: newsaletemp.item.selling_price * newsaletemp.quantity }).
            success(function(data, status, headers, config) {
                
                });
        }
        $scope.removeSaleTemp = function(id) {
            $http.delete(site_url+'/api/saletemp/' + id).
            success(function(data, status, headers, config) {
                $http.get(site_url+'/api/saletemp').success(function(data) {
                        $scope.saletemp = data;
                        });
                });
        }
        $scope.sum = function(list) {
            var total=0;
            angular.forEach(list , function(newsaletemp){
                    total += parseFloat(newsaletemp.selling_price * newsaletemp.quantity);
            });
            return total;
        }
    }]);
})();