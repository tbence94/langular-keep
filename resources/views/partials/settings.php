<div layout="row" layout-align="center center">
    <div class="flex-30">

        <md-card>

            <md-card-content>

                <md-input-container class="md-block">
                    <label>Theme</label>
                    <md-select ng-model="theme">
                        <md-option ng-repeat="theme in themes" ng-value="theme">
                            {{ theme }}
                        </md-option>
                    </md-select>
                </md-input-container>

            </md-card-content>

            <md-card-actions layout="row" layout-align="end center">

                <md-button class="md-icon-button" ng-click="save()">
                    <md-icon class="material-icons">done</md-icon>
                </md-button>

            </md-card-actions>

        </md-card>

    </div>
</div>

