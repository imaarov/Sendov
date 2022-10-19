<?php
namespace Iman\Sendov\Converters;

use Iman\Sendov\FileService;
use Iman\Sendov\Interface\ConverterInterface;

class ExcelConvert implements ConverterInterface{

    public string|array $file_content;

    public function __construct(
        protected FileService $fileService
    )
    {
        $this->convert_file_content();
    }

    public function convert_file_content(): void
    {
        
    }
}