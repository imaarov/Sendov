<?php
namespace Iman\Sendov;

use Iman\Sendov\Enum\FileMimeEnum;

class FileService {

    public bool $file_status;
    public bool $mime_status;

    public function __construct(
        private string $path,

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

    public function validate_mime(): void
    {
        $path_array = explode(DIRECTORY_SEPARATOR, $this->path);
        $file       = end($path_array);
        $file_array = explode('.', $file);
        $mime       = end($file_array);

        $this->mime_status = $mime === FileMimeEnum::JSON->get_mime_name();
    }
}