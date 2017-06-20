<div ng-hide="loading">

    <div ng-show="notes.length==0" class="text-muted text-center">There are no archived notes...</div>

    <md-card class="note" ng-repeat="note in notes">
        <md-card-content>
            <h2> {{ note.title }}
                <small class="pull-right text-muted">Archived {{ note.archived | relativeDate }}</small>
            </h2>
            <p>{{ note.description }}</p>
        </md-card-content>
        <md-card-actions layout="row" layout-align="end center">
            <md-button class="md-icon-button" ng-click="unarchiveNote(note.id)">
                <md-icon class="material-icons">unarchive</md-icon>
            </md-button>
            <md-button class="md-icon-button" ng-click="deleteNote(note.id)">
                <md-icon class="material-icons">delete</md-icon>
            </md-button>
        </md-card-actions>
    </md-card>

</div>

<md-button class="md-fab md-fab-bottom-right" ng-click="clearArchive()">
    <md-icon class="material-icons">clear</md-icon>
</md-button>