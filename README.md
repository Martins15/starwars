# StarWars test task backend

### Installation instructions

1. Install Docker (if you don't have it).
2. Run `docker-compose up` in the current (root) folder.
3. Run `docker exec starwars_php_1 composer install`.
4. Open `localhost:8765` in web browser.


### Unit testing
To run test use the following command:
`docker exec -ti starwars_php_1 api/vendor/bin/phpunit api/tests`
