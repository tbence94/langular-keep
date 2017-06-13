angular.module('notes', [])
    .factory('Note', function ($http) {
        return {
            get: function () {
                return $http.get('/api/notes');
            },

            save: function (noteData) {
                return $http({
                    method: 'POST',
                    url: '/api/notes',
                    data: noteData,
                    paramSerializer: '$httpParamSerializerJQLike'
                });
            },

            update: function (noteData) {
                return $http({
                    method: 'PUT',
                    url: '/api/notes/' + noteData.id,
                    data: noteData,
                    paramSerializer: '$httpParamSerializerJQLike'
                });
            },

            destroy: function (id) {
                return $http.delete('/api/notes/' + id);
            }
        }
    })
    .controller('notesController', function ($scope, $http, Note) {
        $scope.noteData = {};
        $scope.loading = true;

        Note.get()
            .success(function (data) {
                $scope.notes = data;
                $scope.loading = false;
            });

        $scope.editNote = function (note) {
            $scope.noteData = note;
        };

        $scope.submitNote = function () {
            if (!$scope.noteForm.$valid) {
                $scope.alert = true;
                return false;
            }

            $scope.loading = true;

            if ($scope.noteData.id) {
                Note.update($scope.noteData)
                    .success(function (data) {

                        $scope.noteData = {};
                        $scope.noteForm.$setPristine();

                        Note.get()
                            .success(function (getData) {
                                $scope.notes = getData;
                                $scope.loading = false;
                            });
                    });
            } else {
                Note.save($scope.noteData)
                    .success(function (data) {

                        $scope.noteData = {};
                        $scope.noteForm.$setPristine();

                        Note.get()
                            .success(function (getData) {
                                $scope.notes = getData;
                                $scope.loading = false;
                            });

                    });
            }

        };

        $scope.deleteNote = function (id) {
            $scope.loading = true;

            Note.destroy(id)
                .success(function (data) {
                    $scope.notes = data;
                    $scope.loading = false;
                });
        };

    });