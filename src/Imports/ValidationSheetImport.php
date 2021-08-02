<?php

namespace DevNta\Messages\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ValidationSheetImport implements ToCollection, WithHeadingRow
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
        $validationCollection = $collection->groupBy(function ($item, $key) {
            return explode(':', $item['rules'])[0];
        });

        $languages = config('nta_message.languages');
        if (!empty($languages)) {
            foreach ($languages as $k => $lang) {
                $filename = __DIR__ . '/../../resources/lang/' . $k . '/validation.php';
                if (!is_dir(dirname($filename))) {
                    mkdir(dirname($filename), 0755, true);
                }
                $validationFile = fopen(__DIR__ . '/../../resources/lang/' . $k . '/validation.php', 'w');
                $arrayValidate = [];
                foreach ($validationCollection as $key => $value) {
                    if (count($value) > 1) {
                        foreach ($value as $kV => $item) {
                            $arrayValidate[trim($key)][explode(':', trim($item['rules']))[1]] = $item[$lang['text_sheet_validation']] ?? '';
                        }
                    } else {
                        $arrayValidate[trim($key)] = $value[0][$lang['text_sheet_validation']] ?? '';
                    }
                }
                $text = '<?php ' . "\r\n\r\n" . "return " . var_export($arrayValidate, true) . ';';
                fwrite($validationFile, $text);
                fclose($validationFile);
            }
        }
    }

    /**
     * @return int
     */
    public function headingRow(): int
    {
        return 1;
    }
}
