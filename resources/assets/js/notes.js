angular.module('notes', ['ngMaterial', 'relativeDate'])

    .config(function ($mdThemingProvider) {
        $mdThemingProvider.theme('default')
            .primaryPalette('amber')
            .accentPalette('grey');
    })

    .factory('Note', function ($http) {
        return {
            get: function () {
                return $http.get('/api/notes');
            },

            save: function (note) {
                return $http({
                    method: note.id ? 'PUT' : 'POST',
                    url: '/api/notes' + (note.id ? '/' + note.id : ''),
                    data: note,
                    paramSerializer: '$httpParamSerializerJQLike'
                });
            },

            archive: function (id) {
                return $http.put('/api/notes/' + id + '/archive');
            },

            unarchive: function (id) {
                return $http.put('/api/notes/' + id + '/unarchive');
            },

            destroy: function (id) {
                return $http.delete('/api/notes/' + id);
            }
        }
    })

    .directive('showFocus', function ($timeout) {
        return function (scope, element, attrs) {
            scope.$watch(attrs.showFocus,
                function (newValue) {
                    $timeout(function () {
                        newValue && element[0].focus();
                    });
                }, true);
        };
    })

    .controller('notesController', function ($scope, $http, $mdDialog, $timeout, Note) {
        $scope.note = {};
        $scope.loading = true;
        $scope.opened = false;

        var noteEditor = {
            contentElement: '#createNoteDialog',
            clickOutsideToClose: true,
            escapeToClose: true,
            onComplete: function () {
                $scope.opened = true;
                $timeout(function () {
                    $scope.opened = false;
                }, 10);
            }
        };

        Note.get()
            .then(function (response) {
                $scope.notes = response.data;
                $scope.loading = false;
            });


        $scope.createNote = function () {
            $mdDialog.show(noteEditor);
        };

        $scope.editNote = function (note) {
            $scope.note = note;
            $mdDialog.show(noteEditor)
                .then(function (response) {
                    console.log("Then");
                    console.log(response);
                })
                .catch(function (response) {
                    console.log("Catch");
                    console.log(response);
                })
                .finally(function (response) {
                    console.log("Finally");
                    console.log(response);
                });
        };

        $scope.handleEnter = function (event) {
            if (event.ctrlKey && event.keyCode === 13) {
                $scope.submitNote();
            }
        };

        $scope.submitNote = function () {
            if (!$scope.noteForm.$valid) {
                return false;
            }

            $scope.loading = true;

            Note.save($scope.note)
                .then(function (response) {
                    if (!$scope.note.id) {
                        $scope.notes.unshift(response.data);
                    }

                    $mdDialog.hide().then(function () {
                        $scope.note = {};
                        $scope.noteForm.$setPristine();
                    });

                    $scope.loading = false;
                });

        };

        $scope.archiveNote = function (id) {
            $scope.loading = true;

            Note.archive(id)
                .then(function () {
                    $scope.notes = $scope.notes.filter(function (note) {
                        return note.id !== id;
                    });
                    $scope.loading = false;
                })
                .catch(function (response) {
                    console.log(response);
                });
        };


        $scope.unarchiveNote = function (id) {
            $scope.loading = true;

            Note.unarchive(id)
                .then(function () {
                    $scope.notes = $scope.notes.filter(function (note) {
                        return note.id !== id;
                    });
                    $scope.loading = false;
                })
                .catch(function (response) {
                    console.log(response);
                });
        };

        $scope.deleteNote = function (id) {
            $scope.loading = true;

            Note.destroy(id)
                .then(function () {
                    $scope.notes = $scope.notes.filter(function (note) {
                        return note.id !== id;
                    });
                    $scope.loading = false;
                })
                .catch(function (response) {
                    console.log(response);
                });
        };

    });