<?php
namespace Iman\Sendov\Converters;

use Iman\Sendov\FileService;
use Iman\Sendov\Interface\ConverterInterface;
use \PhpOffice\PhpSpreadsheet\IOFactory as IOFactory;
use \PhpOffice\PhpSpreadsheet\Reader\Xls;
// $spread = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile( PUB_URL . "file.xls");
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
        $spread_obj = new Xls();
        $spread_obj->setReadDataOnly(true);
        $spread_obj->load($this->fileService->path);
        // $data = $spread_obj->getSheet($spread_obj->getFirstSheetIndex());
        // var_dump($spread_obj->listWorksheetInfo());
        die($data);
        // $spread_obj->getSheet();
    }
}