<?php

/**
 * @file
 * GraphQL endpoint.
 */

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/tasks.php';

use GraphQL\GraphQL;
use MongoDB\Client as MongoClient;

class StarWarsService implements StarTasksInterface {

  private $config;

  public function __construct(StarConfig $config) {
    $this->db = new MongoClient($config->db);
  }

  /**
   * Which of all Star Wars movies has the longest opening crawl (counted by number of characters)?
   */
  public function getLongestOpening() {
    print $this->db;
  }

  /**
   * What character (person) appeared in most of the Star Wars films?
   */
  public function getPopularCharacter() {

  }

  /**
   * What species (i.e. characters that belong to certain species) appeared in the most number of Star Wars films?
   */
  public function getSpeciesCount() {

  }

  /**
   * What planet in Star Wars universe provided largest number of vehicle pilots?
   */
  public function getPilots() {

  }

}
