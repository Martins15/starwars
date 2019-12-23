<?php

use StarWars\{StarWarsModel, StarConfig};
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../model.php';

class StarTest extends TestCase {

  private $model;

  protected function setUp() {
    $this->model = new StarWarsModel(new StarConfig());
  }

  /**
   * Check getLongestOpening method result.
   */
  public function testLongestOpening() {
    $result = $this->model->getLongestOpening();
    $this->assertTrue(is_string($result) && strlen($result) > 0);
  }

  /**
   * Check getPopularCharacter method result.
   */
  public function testPopularCharacter() {
    $result = $this->model->getPopularCharacter();
    $this->assertTrue(is_array($result) && count($result) > 0);
    foreach ($result as $item) {
      $this->assertTrue(!empty($item));
    }
  }

  /**
   * Check getSpeciesCount method result.
   * @dataProvider limitProvider
   */
  public function testSpeciesCount($limit) {
    $result = $this->model->getSpeciesCount($limit);
    $this->assertTrue(count($result) == $limit);
    foreach ($result as $item) {
      $this->assertTrue(!empty($item['name']));
      $this->assertTrue(!empty($item['count']));
    }
  }

  /**
   * Check getPilots method result.
   * @dataProvider limitProvider
   */
  public function testPilots($limit) {
    $result = $this->model->getPilots($limit);
    $this->assertTrue(count($result) == $limit);
    foreach ($result as $item) {
      $this->assertTrue(!empty($item['name']));
      $this->assertTrue(!empty($item['count']));
      $this->assertTrue(!empty($item['pilots']));
      foreach ($item['pilots'] as $pilot) {
        $this->assertTrue(!empty($pilot['name']));
        // Pilot species not tested as some records in DB are missing.
      }
    }
  }

  /**
   * Provide some random number to use as argument.
   */
  public function limitProvider() {
    return [[rand(1, 10)]];
  }

}
