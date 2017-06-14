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

            destroy: function (id) {
                return $http.delete('/api/notes/' + id);
            }
        }
    })

    .controller('notesController', function ($scope, $http, $mdDialog, Note) {
        $scope.note = {};
        $scope.loading = true;

        var noteEditor = {
            contentElement: '#createNoteDialog',
            parent: angular.element(document.body),
            clickOutsideToClose: true,
            escapeToClose: true
        };

        Note.get()
            .then(function (response) {
                $scope.notes = response.data;
                $scope.loading = false;
            });


        $scope.createNote = function () {
            $mdDialog.show(noteEditor);
            console.log("Hello");
            console.log($scope.noteForm.title.$$element[0]);
            A=$scope.noteForm.title.$$element[0];
            console.log("World");
        };


        $scope.editNote = function (note) {
            $scope.note = note;
            $mdDialog.show(noteEditor);
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

                    $scope.note = {};
                    $scope.noteForm.$setPristine();

                    $mdDialog.cancel();
                    $scope.loading = false;
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