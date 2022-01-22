<?php

require __DIR__ . '/../vendor/autoload.php';

$r = (new \Ichinya\Balabola())->request('Привет', 1);
print_r($r);
