<?php

/**
 * @file
 * Custom 'planet' data type for GraphQL.
 */

namespace GraphQL\Type\Definition;

class PlanetType extends ObjectType {
  public function __construct() {
    $config = [
      'name' => 'PlanetType',
      'description' => 'Planet object type',
      'fields' => function() {
        return [
          'name' => [
            'type' => Type::string(),
            'description' => 'Planet name',
          ],
          'count' => [
            'type' => Type::int(),
            'description' => 'Number of pilots',
          ],
          'pilots' => [
            'type' => Type::listOf(Type::listOf(Type::string())),
            'description' => 'List of pilots',
          ],
        ];
      }
    ];
    parent::__construct($config);
  }
}
