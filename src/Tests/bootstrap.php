<?php

$file = __DIR__.'/../../vendor/autoload.php';
if (!file_exists($file)) {
    throw new RuntimeException('Dependencies missing. Please install via composer before executing tests.');
}

$autoload = require_once $file;
