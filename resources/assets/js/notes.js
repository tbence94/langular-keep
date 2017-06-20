angular.module('notes', ['relativeDate'])

    .factory('Note', function ($http) {
        return {
            get: function () {
                return $http.get('/api/notes');
            },

            archived: function () {
                return $http.get('/api/notes/archived');
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
            },

            clearArchive: function () {
                return $http.delete('/api/notes/archived');
            }
        }
    })

    .controller('noteController', function ($scope, Note, $mdDialog) {

        // Define
        $scope.note = {};

        var noteEditor = {
            contentElement: '#createNoteDialog',
            clickOutsideToClose: true,
            escapeToClose: true
        };

        // Initiazlie
        Note.get().then(function (response) {
            $scope.notes = response.data;
            $scope.stopLoading();
        });

        // Add functions
        $scope.createNote = function () {
            $mdDialog.show(noteEditor);
        };

        $scope.editNote = function (note) {
            $scope.note = note;
            $mdDialog.show(noteEditor);
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

            Note.save($scope.note)
                .then(function (response) {
                    if (!$scope.note.id) {
                        $scope.notes.unshift(response.data);
                    }

                    $mdDialog.hide().then(function () {
                        $scope.note = {};
                        $scope.noteForm.$setPristine();
                    });
                });
        };

        $scope.archiveNote = function (id) {
            Note.archive(id)
                .then(function () {
                    $scope.notes = $scope.notes.filter(function (note) {
                        return note.id !== id;
                    });
                });
        };

        $scope.deleteNote = function (id) {
            Note.destroy(id)
                .then(function () {
                    $scope.notes = $scope.notes.filter(function (note) {
                        return note.id !== id;
                    });
                });
        };

    })
    .controller('archiveController', function ($scope, $mdDialog, Note) {

        Note.archived()
            .then(function (response) {
                $scope.notes = response.data;
                $scope.stopLoading();
            });


        $scope.unarchiveNote = function (id) {
            Note.unarchive(id).then(function () {
                $scope.notes = $scope.notes.filter(function (note) {
                    return note.id !== id;
                });
            }).catch(function () {
                $mdDialog.alert({
                    title: 'Error!',
                    description: 'Unexpected error, try again later!',
                    ok: 'Cancel'
                });
            });
        };

        $scope.deleteNote = function (id) {
            Note.destroy(id)
                .then(function () {
                    $scope.notes = $scope.notes.filter(function (note) {
                        return note.id !== id;
                    });
                });
        };

        $scope.clearArchive = function () {

            $mdDialog.show($mdDialog.confirm({
                title: 'Clear all archived notes',
                textContent: 'Would you like to remove all archived notes? You can\'t undo this operation!',
                ok: 'Delete them all!',
                cancel: 'I don\'t want to do this!',
                escapeToClose: true,
            })).then(function () {
                $scope.startLoading();
                Note.clearArchive().then(function () {
                    $scope.notes = [];
                    $scope.stopLoading();
                }).catch(function () {
                    $scope.stopLoading();
                    $mdDialog.alert({
                        title: 'Error!',
                        description: 'Unexpected error, try again later!',
                        ok: 'Cancel'
                    });
                });
            });


        };

    });