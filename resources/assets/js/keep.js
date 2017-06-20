angular.module('keep', ['notes', 'settings', 'ui.router', 'ngMaterial', 'relativeDate'])

    .config(function ($mdThemingProvider) {
        $mdThemingProvider.theme('default')
            .primaryPalette('amber')
            .accentPalette('grey');
    })

    .config(function ($stateProvider, $locationProvider, $urlRouterProvider) {

        $locationProvider.html5Mode(true);
        $urlRouterProvider.otherwise('notes');

        $stateProvider.state({
            name: 'root',
            url: '',
            redirectTo: 'notes'
        });

        $stateProvider.state({
            name: 'home',
            url: '/',
            redirectTo: 'notes'
        });

        $stateProvider.state({
            name: 'notes',
            url: '/notes',
            templateUrl: 'view/partials/notes',
            controller: 'noteController'
        });

        $stateProvider.state({
            name: 'archive',
            url: '/archive',
            templateUrl: 'view/partials/archive',
            controller: 'archiveController'
        });

        $stateProvider.state({
            name: 'settings',
            url: '/settings',
            templateUrl: 'view/partials/settings',
            controller: 'settingsController'
        });

    })

    .run(function ($rootScope, $state) {

        // console.log($state);
        // $state.go('notes');

        $rootScope.$on('$stateChangeStart', function (e, toState, toParams) {
            if (toState.redirectTo) {
                $state.go(toState.redirectTo, toParams);
                e.preventDefault();
            }

            $rootScope.startLoading();
        });
    })

    .controller('keepController', function ($rootScope) {

        $rootScope.loading = true;

        $rootScope.startLoading = function () {
            $rootScope.loading = true;
        };

        $rootScope.stopLoading = function () {
            $rootScope.loading = false;
        };

        $rootScope.toggleLoading = function () {
            $rootScope.loading = !$rootScope.loading;
        }

    });