<?php

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/service.php';

$service = new StarWarsService(new StarConfig());
