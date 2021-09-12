<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Gambling.com</title>
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
        <link href="https://rawgit.com/thatguynamedandy/angular-casino-lights/master/dist/casino-lights.css" rel="stylesheet" type="text/css" />
        <link href="http://fonts.googleapis.com/css?family=Raleway:700" rel="stylesheet" type="text/css">
        <style>
            .wrapper {
                margin: 1em auto;
                width: 95%;
            }
        </style>
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular.js"></script>
        <script src="https://rawgit.com/thatguynamedandy/angular-casino-lights/master/dist/casino-lights.js"></script>
        <script type="text/javascript">
            angular.module('casino-demo', [
                'casino-lights'
            ])
                .controller('CasinoDemo', function($scope) {

                    $scope.config = {
                        speed: 30,
                        power: false
                    };

                    $scope.config.power = true;

                });
        </script>
    </head>
    <body ng-app="casino-demo">
        <div class="wrapper">
            <section class="row" ng-controller="CasinoDemo">
                <div class="col-sm-8">
                    <h1 data-casino-lights config="config">WELCOME</h1>
                    <h2>Gambling.com Attendees:</h2>
                </div>
            </section>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Distance</th>
                    <th scope="col">Aff ID</th>
                </tr>
                </thead>
                <tbody>
                @if($file_exists)
                    @foreach ($attendees as $attendee)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $attendee->name }}</td>
                            <td>{{ $attendee->distance }}</td>
                            <td>{{ $attendee->affiliate_id }}</td>
                        </tr>
                    @endforeach
                @else
                    <p>Sorry, no party for you :(</p>
                @endif

                </tbody>
            </table>
        </div>

    </body>
</html>
