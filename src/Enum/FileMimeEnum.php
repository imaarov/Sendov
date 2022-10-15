<?php
namespace Iman\Sendov\enum;


enum FileMimeEnum: int {
    case JSON  = 1;
    case EXCEL = 2;

    public function get_mime_name(): string 
    {
        return match($this) {
            FileMimeEnum::JSON   =>   'json'
        };
    } 
}