# profiles-api

#### Folder structure
This project is built using Docker and PHP 7.4 with a DDD approach. 
This leads to three main folders: (https://en.wikipedia.org/wiki/Domain-driven_design)
* *Application*: services to interact with the domain of the application.
* *Domain*: entities, domain exceptions and interfaces to handle domain layer.
* *Infrastructure*: concrete implementations of the domain.

#### Requirements
In order to run this project you will need:

* Docker (https://www.docker.com/community-edition)
* Docker compose (https://docs.docker.com/compose/install/)

#### Local environment

* Nginx (To connect from your machine use localhost:8030)
* PHP 7.4 (FPM)
* MySQL (To connect from your machine use localhost and port 3390)

If you use Linux a *Makefile* is included, so you can run these commands to start and stop all containers at once.
Go to project root and run:

To start docker
```
make up
```

To stop docker
```
make down
```

#### First time instructions:

###### Linux
1) Install Docker and Docker compose
2) Create .env file using .env.example info (Modify paths if needed)
3) In project root execute ``` make up ```
4) In project root execute ``` make php ``` and go inside php docker.
5) Execute ``` composer install ```
6) Apply database dump ``` php bin/console orm:schema-tool:update --force ```
7) Create ``` cache ``` and ``` logs ``` folders.
8) ``` chmod -R 777 cache ``` and ``` chmod -R 777 logs ```

###### Windows 10
1) Install Docker
2) Create .env file using .env.example info (Modify paths if needed)
3) In project root execute ``` docker-compose up -d ```
4) In project root execute ``` docker exec -it php-maxinuss-container bash ``` and go inside php docker.
5) Execute ``` composer install```
6) Apply database dump ``` php bin/console orm:schema-tool:update --force ```
7) Create ``` cache ``` and ``` logs ``` folders.

#### Endpoints
Postman collection: [Download here](utils/postman_collection.json)

#### Running test
This project is tested under PHPUnit and includes a unit test suite:

Inside the docker container (```make php``` on linux or ```docker exec -it php-maxinuss-container bash``` in windows)
```
php vendor/bin/phpunit
```
