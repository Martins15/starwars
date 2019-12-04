<?php

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/graphql.php';

$service = new StarWarsService(new StarConfig());

print_r($service);