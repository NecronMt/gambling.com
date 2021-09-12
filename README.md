# Gambling.com

## Test

We have a shortlist of affiliate contact records in a text file (affiliates.txt) -- one affiliate per line, JSON-encoded. We want to invite any affiliate that lives within 100km of our Dublin office for some food and drinks using this text file as the input (Don't alter). Write a program that will read the full list of affiliates from this txt file and output the name and affiliate ids of matching affiliates (within 100km), sorted by Affiliate ID (ascending).

You can use the first formula from this [Wikipedia article](https://en.wikipedia.org/wiki/Great-circle_distance) to calculate distance. Don't forget, you'll need to convert degrees to radians.

The GPS coordinates for our Dublin office are 53.3340285, -6.2535495.

You can find the affiliate list in this repository called affiliates.txt.

Please don’t forget, your code should be production ready, clean and tested!

### Test Nice to haves:

- Demonstrate understanding of MVC
- Unit Tests
- Basic HTML output
- Usage of a PHP Framework (Not necessary but as a Laravel based company it's a bonus)
- Use original txt file as input

## Requirements

Docker Desktop v3 or later

WSL2 installed & set up

Make sure the /var/www folder permissions are under ```www-data```

## Project Installation

Go to the ```laravel-docker``` directory.

Go to the ```src/``` directory and copy the .env.example to .env.

Run ```docker-compose up -d --build``` to build the dockers.

Go into the php-apache docker, ```docker-compose exec php-apache /bin/bash``` and run ```php artisan key:generate```.

Go to ```http://localhost:8080/``` to view the app.

## Useful Commands

DB bash: ```docker-compose exec database /bin/bash```

PHP bash: ```docker-compose exec php-apache /bin/bash```

Run PHP Unit Tests: ```./vendor/bin/phpunit``` or ```php artisan test``` for full details

The ```composer dump-autoload``` regenerates the list of classes needed within the project

## Notes

The app .env files should be set up depending on environments. Debugging would be enabled on a DEV server, whilst #
staging and production servers would have logs to other systems such as Elkstack, etc. 