<!doctype html>
<html>
<head>
    <title>Langular keep</title>
    <base href="/">
    <!-- CSS -->
    <!--    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/angular.css">
    <link rel="stylesheet" href="/css/icons/material-icons.css">
    <link rel="stylesheet" href="/css/app.css">

</head>
<body ng-app="keep" ng-controller="keepController" md-theme="theme">

<div layout="column" layout-fill>

    <md-toolbar>

        <div class="md-toolbar-tools">
            <h2 md-truncate flex>Langular keep</h2>
        </div>

    </md-toolbar>

    <div flex layout="row">

        <md-sidenav class="md-whiteframe-4dp" md-is-locked-open="$mdMedia('gt-sm')">
            <ng-include src="'view/nav'"></ng-include>
        </md-sidenav>

        <md-content id="content" flex layout-padding>
            <div class="flex-80">

                <div ng-show="loading" layout="row" layout-align="center center">
                    <md-progress-circular></md-progress-circular>
                </div>

                <ui-view></ui-view>

            </div>
        </md-content>

    </div>

</div>


<!-- JS -->
<script src="/js/angular.js"></script>
<script src="/js/app.js"></script>

</body>
</html>