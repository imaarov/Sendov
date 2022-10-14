<?php
namespace Iman\Sendov;

class FileService {

    public function __construct(
        private string $path,

    )
    { }

    public function run()
    {
        return $this->validate_path();
    }

    /**
     * Check file exists
     * 
     * @param 
     * @return bool
     */
    public function validate_path(): bool
    {
        return file_exists($this->path);
    }
}