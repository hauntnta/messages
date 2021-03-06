<?php

namespace DevNta\Messages\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class LangSheetImport implements ToCollection, WithHeadingRow
{

    /**
     * @var
     */
    protected $sheetName;

    /**
     * @param $sheetName
     */
    public function __construct($sheetName)
    {
        $this->sheetName = $sheetName;
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $languages = config('nta_message.languages');
        if (!empty($languages)) {
            foreach ($languages as $kLang => $lang) {
                $filename = __DIR__ . '/../../resources/lang/' . $kLang . '/nta_' . $this->sheetName . '.php';
                if (!is_dir(dirname($filename))) {
                    mkdir(dirname($filename), 0755, true);
                }
                $commonFile = fopen($filename, 'w');
                $common = [];
                foreach ($collection->toArray() as $key => $value) {
                    $context = $value[$lang['text_sheet_lang']] ?? '';
                    if (!empty($value['code'])) {
                        $common[$value['code']] = $context;
                    }
                }
                $text = '<?php ' . "\r\n\r\n" . "return " . var_export($common, true) . ';';
                fwrite($commonFile, $text);
                fclose($commonFile);
            }
        }
    }

    public function headingRow(): int
    {
        return 1;
    }
}
