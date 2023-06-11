<?php
namespace Imaarov\Sendov\Converters;

use Imaarov\Sendov\FileService;
use Imaarov\Sendov\Interface\ConverterInterface;

class JsonConvert implements ConverterInterface {

    public string|array $file_content;

    public function __construct(
        protected FileService $fileService
    )
    {
        $this->convert_file_content();
    }

    /**
     * get file content and convert it to json
     * 
     * @param
     * @return void
     */
    public function convert_file_content(): void
    {
        $this->file_content = json_decode(
            file_get_contents(
                $this
                    ->fileService
                    ->path
            ),
            true
        );
    }

}