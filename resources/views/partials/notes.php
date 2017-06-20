<div ng-hide="loading">

    <div ng-show="notes.length==0" class="text-muted text-center">There are no notes yet...</div>

    <md-card class="note" ng-repeat="note in notes">
        <md-card-content ng-click="editNote(note)">
            <h2> {{ note.title }}
                <small class="pull-right text-muted">{{ note.date | relativeDate }}</small>
            </h2>
            <p>{{ note.description }}</p>
        </md-card-content>
        <md-card-actions layout="row" layout-align="end center">
            <md-button class="md-icon-button" ng-click="editNote(note)">
                <md-icon class="material-icons">edit</md-icon>
            </md-button>
            <md-button class="md-icon-button" ng-click="archiveNote(note.id)">
                <md-icon class="material-icons">archive</md-icon>
            </md-button>
            <md-button class="md-icon-button" ng-click="deleteNote(note.id)">
                <md-icon class="material-icons">delete</md-icon>
            </md-button>
        </md-card-actions>
    </md-card>

</div>

<md-button class="md-fab md-fab-bottom-right" ng-click="createNote($event)">
    <md-icon class="material-icons">add</md-icon>
</md-button>

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