<?php
namespace Imaarov\Sendov\Converters;

use Imaarov\Sendov\FileService;
use Imaarov\Sendov\Interface\ConverterInterface;
use \PhpOffice\PhpSpreadsheet\IOFactory;
// $spread = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile( PUB_URL . "file.xls");
class ExcelConvert implements ConverterInterface{

    public string|array $file_content;

    public function __construct(
        protected FileService $fileService,
        protected array $required_excel_column
    )
    {
        $this->convert_file_content();
    }

    public function convert_file_content(): void
    {
        $reader = IOFactory::load($this->fileService->path);
        $reader_count = $reader->getSheetCount();
        $sheet = $reader->getSheet(0);
        $sheet_array = $sheet->toArray(null, true, true, true);
        $c = 0;
        $key_data = [];
        foreach ($sheet_array as $key => $value) {
            $c++;
            $coloumn = array_keys($value);
            $verified_array = array_intersect($coloumn, $this->required_excel_column);
            var_dump($value);exit;
        }
        
        
    }
}