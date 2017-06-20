angular.module('keep', ['notes', 'settings', 'ui.router', 'ngMaterial', 'relativeDate'])

    .constant('themes', {
        'default': {
            primaryColor: 'amber',
            accentColor: 'grey',
            warnColor: 'red'
        },
        'yellow': {
            primaryColor: 'yellow',
            accentColor: 'orange',
            warnColor: 'red'
        },
        'blue': {
            primaryColor: 'blue',
            accentColor: 'cyan',
            warnColor: 'red'
        },
        'pink': {
            primaryColor: 'pink',
            accentColor: 'red',
            warnColor: 'red'
        }
    })

    .config(function ($mdThemingProvider, themes) {

        for (var theme in themes) {
            if (!themes.hasOwnProperty(theme)) continue;

            $mdThemingProvider.theme(theme)
                .primaryPalette(themes[theme].primaryColor)
                .accentPalette(themes[theme].accentColor)
                .accentPalette(themes[theme].warnColor);
        }

        $mdThemingProvider.alwaysWatchTheme(true);

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

        $rootScope.theme = 'default';

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