angular.module('settings', [])

    .controller('settingsController', function ($rootScope, $scope, themes) {
        $scope.themes = Object.keys(themes);
        $scope.theme = $rootScope.theme;
        $scope.stopLoading();

        $scope.save = function(){
          $rootScope.theme = $scope.theme;
        };
    });