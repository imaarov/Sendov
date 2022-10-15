#!/usr/bin/php
<?php

use Iman\Sendov\Converters\JsonConvert;
use Iman\Sendov\Enum\FileMimeEnum;
use Iman\Sendov\FileService;
use Iman\Sendov\SendRequestService;

require_once 'vendor/autoload.php';

// CONSTANSTS
define("BASE_URL", __DIR__ . DIRECTORY_SEPARATOR);
define("PUB_URL", __DIR__ . DIRECTORY_SEPARATOR . "public". DIRECTORY_SEPARATOR);

// RULES
echo PHP_EOL."!!!!!!!!!!!ALL FILES MUST BE IN PUBLIC DIRECTORY!!!!!!!!!!!" . PHP_EOL . PHP_EOL;

$path = (string)readline("Enter your file name: ");
$mime = (int)readline("
    1: json
    2: excel
");
$key = (string)readline("Enter your key of file: ");
$url  = (string)readline("Enter the api url: ");
$file_service = new FileService(path: PUB_URL . $path);
$result = match($mime) {
    FileMimeEnum::JSON->value   =>   new JsonConvert($file_service),
    default                     =>   false
};

$request = new SendRequestService(
    converter: $result,
    url: $url,
    key: $key
);
$request->send();
