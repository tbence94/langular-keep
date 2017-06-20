angular.module('settings', [])

    .constant('palette', [
        'red',
        'pink',
        'purple',
        'deep-purple',
        'indigo',
        'blue',
        'light-blue',
        'cyan',
        'teal',
        'green',
        'light-green',
        'lime',
        'yellow',
        'amber',
        'orange',
        'deep-orange',
        'brown',
        'grey',
        'blue-grey'
    ])

    .controller('settingsController', function ($scope, palette, $mdThemingProvider) {
        $scope.stopLoading();
    });