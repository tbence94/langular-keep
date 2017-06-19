<!doctype html>
<html>
<head>
    <title>Langular keep</title>

    <!-- CSS -->
    <!--    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/angular.css">
    <link rel="stylesheet" href="/css/icons/material-icons.css">
    <link rel="stylesheet" href="/css/app.css">

    <!-- JS -->
    <!--    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular.min.js"></script>-->
    <script src="/js/angular.js"></script>
    <script src="/js/notes.js"></script>
</head>
<body ng-app="notes" ng-controller="notesController" md-theme="default">

<div class="hidden">
    <div class="md-dialog-container" id="createNoteDialog">
        <md-dialog layout-padding flex="50">
            <md-dialog-content>

                <form name="noteForm" ng-submit="submitNote()" novalidate>
                    <md-input-container class="md-block">
                        <label for="noteTitle">Title</label>
                        <input id="noteTitle" name="title" ng-model="note.title" autocomplete="off" required show-focus="opened">
                    </md-input-container>


                    <md-input-container class="md-block">
                        <label for="noteDescription">Description</label>
                        <textarea id="noteDescription" name="description" ng-model="note.description" autocomplete="off" ng-keyup="handleEnter($event)"></textarea>
                    </md-input-container>
                    <md-button type="submit" class="md-primary md-raised">Submit</md-button>
                </form>

            </md-dialog-content>
        </md-dialog>
    </div>
</div>

<div layout="column" layout-fill>
    <md-toolbar>

        <div class="md-toolbar-tools">
            <h2 md-truncate flex>Langular keep</h2>
        </div>

    </md-toolbar>

    <div flex layout="row">

        <md-sidenav class="md-whiteframe-4dp" md-is-locked-open="$mdMedia('gt-sm')">

            <md-menu-item>
                <md-button>
                    <md-icon class="material-icons">note</md-icon>
                    Notes
                </md-button>
            </md-menu-item>
            <md-menu-item>
                <md-button ng-click="createNote()">
                    <md-icon class="material-icons">create</md-icon>
                    New note
                </md-button>
            </md-menu-item>
            <md-menu-item>
                <md-button>
                    <md-icon class="material-icons">archive</md-icon>
                    Archie
                </md-button>
            </md-menu-item>

        </md-sidenav>

        <md-button class="md-fab md-fab-bottom-right" ng-click="createNote($event)">
            <md-icon class="material-icons">add</md-icon>
        </md-button>

        <md-content id="content" flex layout-padding>
            <div class="flex-80">

                <div ng-show="loading" layout="row" layout-align="center center">
                    <md-progress-circular></md-progress-circular>
                </div>

                <div ng-hide="loading">
                    <div ng-show="notes.length==0" class="text-muted text-center">There are no notes yet...</div>

                    <md-card class="note" ng-repeat="note in notes">
                        <md-card-content ng-click="editNote(note)">
                            <h2>
                                {{ note.title }}
                                <small class="pull-right text-muted">{{ note.date | relativeDate }}</small>
                            </h2>
                            <p>{{ note.description }}</p>
                        </md-card-content>
                        <md-card-actions layout="row" layout-align="end center">
                            <md-button class="md-icon-button" ng-click="editNote(note)"><md-icon class="material-icons">edit</md-icon></md-button>
                            <md-button class="md-icon-button" ng-click="archiveNote(note.id)"><md-icon class="material-icons">archive</md-icon></md-button>
                            <md-button class="md-icon-button" ng-click="deleteNote(note.id)"><md-icon class="material-icons">delete</md-icon></md-button>
                        </md-card-actions>
                    </md-card>

                </div>

            </div>

        </md-content>

    </div>

</div>

</body>
</html>