var automateApp = angular.module('automateApp', [ ]);

automateApp.controller('automateController', ['$scope', '$http', function($scope, $http){

        $scope.qty = 1;
        $scope.course_fee = 0;
        $scope.discount = 0;
        $scope.unit_price = 0;
        
        $scope.payment = 0;
        $scope.amount = 0;
        $scope.interest = 0;
        $scope.installment_qty = 0;

        $scope.insterests = function(){
                return  ($scope.amount * $scope.interest)/100;
        };
}]);