<?php
namespace Iman\Sendov\converters;

use Iman\Sendov\FileService;

class JsonConvert {

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
    public function convert_file_content()
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