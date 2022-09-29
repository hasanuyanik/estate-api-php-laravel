# Estate App

Application that records real estate promotion appointments. Transactions are done with endpoints. GoogleMaps Api is used for calculations.

## Technical 

- [Laravel 9](https://laravel.com/docs/9.x)
- [Google Maps - Distance Matrix Api](https://developers.google.com/maps/documentation/distance-matrix/overview)
- [JWT](https://jwt-auth.readthedocs.io/en/develop/laravel-installation/)
- [Heroku](https://www.heroku.com/)

## Features

-  Appointments add on appointments and contacts. 
-  User add on users table.
-  When Appointment create and update, ıt's calculation with Google Maps Distance Matrix Api for distance and estimate departure.

Appointment, Contact, User model actions is done with service-repository pattern.

## Installation

Estate App requires [Docker](https://www.docker.com/) to run.

Install the dependencies and devDependencies and start the server.

```sh
cd estate-app
sail up -d OR docker-compose up -d
```

Database migration...

```sh
sail artisan migrate
```

[For Heroku actions](https://devcenter.heroku.com/articles/git)

## ENV or HEROKU Config Vars

```
APP_DEBUG = true
APP_ENV = production
APP_KEY = ***
APP_NAME = ***
APP_URL = http://localhost or heroku url

APPOINTMENT_DURATION = 60 // minute
GOOGLE_DISTANCE_MATRIX_API_KEY = api key
GOOGLE_DISTANCE_MATRIX_API_URL = https://maps.googleapis.com/maps/api/distancematrix/json
JWT_SECRET = your jwt secret key
REALTOR_ZIP_CODE = your reference zip

DATABASE_URL = heroku db url
DB_CONNECTION = pqsql
DB_DATABASE = your database
DB_HOST = your db host
DB_PASSWORD = your db pass
DB_PORT = your db port
DB_USERNAME = your db username

```
