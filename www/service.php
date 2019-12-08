<?php

/**
 * @file
 * GraphQL endpoint.
 */

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/tasks.php';

use MongoDB\Collection as MongoCollection;
use MongoDB\Driver\Manager as MongoManager;

class StarWarsService implements StarTasksInterface {

  private $dbmanager;
  private $dbname;

  public function __construct(StarConfig $config) {
    $this->dbmanager = new MongoManager($config->dbstring);
    $this->dbname = $config->dbname;
  }

  /**
   * Which of all Star Wars movies has the longest opening crawl (counted by number of characters)?
   */
  public function getLongestOpening() {
    $collection = $this->collection('films');
    $films = $collection->find([], ['projection' => ['opening_crawl'=> 1, 'title'=> 1]])->toArray();

    usort($films, function($a, $b) {
      return strlen($b->opening_crawl) <=> strlen($a->opening_crawl);
    });

    $longest = array_shift($films);

    return $longest['title'];
  }

  /**
   * What character (person) appeared in most of the Star Wars films?
   */
  public function getPopularCharacter() {
    //@TODO
  }

  /**
   * What species (i.e. characters that belong to certain species) appeared in the most number of Star Wars films?
   */
  public function getSpeciesCount($limit = 0) {
    //@TODO
  }

  /**
   * What planet in Star Wars universe provided largest number of vehicle pilots?
   */
  public function getPilots($limit = 0) {
    //@TODO
  }

  /**
   * Returns collection of db data.
   *
   * @param $name
   *
   * @return \MongoDB\Collection
   */
  private function collection($name) {
    return new MongoCollection($this->dbmanager, $this->dbname, $name);
  }
}
