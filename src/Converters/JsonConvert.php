<?php
namespace Iman\Sendov\converters;

use Iman\Sendov\FileService;

class JsonConvert {

    public function __construct(
        protected FileService $fileService
    )
    { }
}