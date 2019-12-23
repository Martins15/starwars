# StarWars test task backend

### Installation instructions

1. Install Docker (if you don't have it).
2. Run `docker-compose up` in the current (root) folder.
3. Run `docker exec starwars_php_1 composer install -d /var/www/api`. If you have any troubles with this command, try to log into `starwars_php_1` container using `docker exec -ti starwars_php_1 bash`, navigate (cd) to `/var/www/api` folder, and run `composer install` inside it.
4. Open `localhost:8765` in web browser.


### Unit testing
To run test use the following command:
`docker exec -ti starwars_php_1 api/vendor/bin/phpunit api/tests`
