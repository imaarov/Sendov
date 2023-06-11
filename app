#!/usr/bin/php
<?php

use Imaarov\Sendov\enum\FileMimeEnum;
use Imaarov\Sendov\FileService;
use Imaarov\Sendov\LogService;
use Imaarov\Sendov\SendRequestService;
use Imaarov\Sendov\Converters\ExcelConvert;
use Imaarov\Sendov\Converters\JsonConvert;

require_once 'vendor/autoload.php';

// some url constant
define("BASE_URL", __DIR__ . DIRECTORY_SEPARATOR);
define("PUB_URL", __DIR__ . DIRECTORY_SEPARATOR . "public". DIRECTORY_SEPARATOR);
define("LOG_URL", __DIR__ . DIRECTORY_SEPARATOR . "log" . DIRECTORY_SEPARATOR . "data.log");

// RULES
$rules = [
  "ALL FILES MUST BE IN PUBLIC DIRECTORY"
];

function app(array $rules): int {
  //? Rules
  echo "****************** RULES ********************* " . PHP_EOL;
  foreach ($rules as $value) {
    echo PHP_EOL . "!!!!!!!!!! $value !!!!!!!!!!!" . PHP_EOL;
  }

  //? User input
  $path = (string)readline("Enter your file name: ");
  $mime = (int)readline("
    1: json
    2: excel
  \n");

  //? File info and destination url
  $key = (string)readline("Enter your key of file: ");
  $url  = (string)readline("Enter the api url: ");
  $file_service = new FileService(path: PUB_URL . $path);
  // $data = new ExcelConvert($file_service, ['A', 'B', 'C', 'D']);
  echo $mime;
  $result = match ($mime) {
    FileMimeEnum::JSON->value   =>   new JsonConvert($file_service),
    default                     =>   false
  };

  $request = new SendRequestService(
    converter: $result,
    url: $url,
    key: $key,
    log_service: new LogService(LOG_URL)
  );
  $request->send();

  return 0;
}


app($rules);