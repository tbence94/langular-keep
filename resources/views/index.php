<!doctype html>
<html>
<head>
    <title>Langular Keep</title>

    <!-- CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    <style>
        body {
            padding-top: 30px;
        }

        form {
            padding-bottom: 20px;
        }

        .note {
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0px 0px 5px rgba(0,0,0,0.2);
        }

        .note h3{
            margin-top: 0;
        }

        .ng-dirty.ng-invalid {
            border-color: red !important;
        }

        .ng-dirty.ng-valid {
            border-color: green !important;
        }

        *:focus{
            outline: none !important;
        }
    </style>

    <!-- JS -->
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular.min.js"></script>
    <script src="/js/notes.js"></script>
</head>
<body class="container" ng-app="notes" ng-controller="notesController">
<div class="col-md-8 col-md-offset-2">

    <div class="page-header">
        <h2>Langular keep</h2>
    </div>

    <form name="noteForm" ng-submit="submitNote()" novalidate>
        <div class="form-group">
            <input type="text" class="form-control input-lg" ng-class="{'ng-dirty': alert}" name="title" ng-model="noteData.title" placeholder="Title"
                   required>
        </div>

        <div class="form-group">
            <textarea class="form-control input-sm" name="description" ng-model="noteData.description"
                      placeholder="Say what you have to say" rows="8"></textarea>
        </div>

        <div class="form-group text-right">
            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
        </div>

    </form>

    <p class="text-center" ng-show="loading"><span class="fa fa-spinner fa-2x fa-spin"></span></p>

    <div ng-hide="loading">
        <div ng-show="notes.length==0" class="text-muted text-center">There are no notes yet...</div>
        <div class="note" ng-repeat="note in notes">
            <h3>
                {{ note.title }}
                <small class="pull-right">Note #{{ note.id }}</small>
            </h3>
            <p>{{ note.description }}</p>
            <hr>
            <a href="#" ng-click="editNote(note)" class="text-muted">Edit</a> |
            <a href="#" ng-click="deleteNote(note.id)" class="text-muted">Delete</a>
        </div>
    </div>

</div>
</body>
</html>