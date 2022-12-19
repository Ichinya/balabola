<?php

require __DIR__ . '/../vendor/autoload.php';

$r = (new \Ichinya\Balabola())->request('Привет', \Ichinya\TypeIntro::SHORT_STORY, 1);
print_r($r);
