<?php
namespace Imaarov\Sendov;

use Iman\Sendov\Enum\FileMimeEnum;

class FileService {

    public bool $file_status;
    public bool $mime_status;
    public string $mime;
    public string $file;

    public function __construct(
        public string $path,

    )
    {
        $this->validate_path();
        $this->validate_mime();
    }


    /**
     * Check file exists
     * 
     * @param 
     * @return bool
     */
    public function validate_path(): void
    {
        $this->file_status = file_exists($this->path);
    }
  
    /**
     * Check file mime is valida for a json file
     *
     * @param
     * @return void
     */
    public function validate_mime(): void
    {
        $path_array = explode(DIRECTORY_SEPARATOR, $this->path);
        $file       = end($path_array);
        $file_array = explode('.', $file);
        $mime       = end($file_array);

        $this->mime = $mime;
        $this->file = $file;
        $this->mime_status = $mime === FileMimeEnum::JSON->get_mime_name();
    }
}
