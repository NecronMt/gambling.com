<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gambling.com</title>

    <style>
        .wrapper {
            margin: 1em auto;
            width: 95%;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <h1>Gambling.com</h1>
    <p>Welcome to the party :D</p>
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
            {{$file_exists}}
        @else
            <p>Sorry, no party for you :(</p>
        @endif

        </tbody>
    </table>
</div>
</body>
</html>
