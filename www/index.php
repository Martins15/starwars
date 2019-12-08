<?php

/**
 * @file
 * This is our main endpoint.
 */

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/model.php';
require_once __DIR__ . '/types/Planet.php';

use GraphQL\GraphQL;
use GraphQL\Type\Schema;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\PlanetType;

$input_raw = file_get_contents('php://input');

if (!$input_raw) {
  die("Endpoint works, but no input provided :(");
}

try {
  $input = json_decode($input_raw, TRUE);
  $query = $input['query'];
  $context = [
    'model' => new StarWarsModel(new StarConfig())
  ];

  // Create data type and it's fields.
  $query_type = new ObjectType([
    'name' => 'Query',
    'fields' => [
      'longestOpening' => [
        'type' => Type::string(),
        'resolve' => function ($source, $args, $context) {
          $model = $context['model'];
          return $model->getLongestOpening();
        }
      ],
      'popularCharacter' => [
        'type' => Type::listOf(Type::string()),
        'resolve' => function ($source, $args, $context) {
          $model = $context['model'];
          return $model->getPopularCharacter();
        }
      ],
      'speciesCount' => [
        'type' => Type::listOf(Type::listOf(Type::string())),
        'args' => ['limit' => Type::int()],
        'resolve' => function ($source, $args, $context) {
          $model = $context['model'];
          return $model->getSpeciesCount($args['limit']);
        }
      ],
      'pilots' => [
        'type' => Type::listOf(new PlanetType()),
        'args' => ['limit' => Type::int()],
        'resolve' => function ($source, $args, $context) {
          $model = $context['model'];
          return $model->getPilots($args['limit']);
        }
      ],
    ]
  ]);

  // Create schema.
  $schema = new Schema([
    'query' => $query_type
  ]);

  // Run query.
  $result = GraphQL::executeQuery($schema, $query, NULL, $context)->toArray();
} catch (\Exception $e) {
  $result = [
    'error' => [
      'message' => $e->getMessage()
    ]
  ];
}

// Output result.
header('Content-Type: application/json; charset=UTF-8');
echo json_encode($result);
