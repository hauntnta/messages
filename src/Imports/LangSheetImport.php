<?php

namespace DevNta\Messages\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class LangSheetImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $collection)
    {
        $languages = config('nta_message.languages');
        $baseLang = config('nta_message.sheet.base_lang');
        if (!empty($languages)) {
            foreach ($languages as $kLang => $lang) {
                foreach ($baseLang as $b => $file) {
                    /*
                     * slice lang collection
                     * offset = STT sheet EN-JP
                     * */
                    $filename = __DIR__ . '/../../resources/lang/' . $kLang . '/' . $b . '.php';
                    if (!is_dir(dirname($filename))) {
                        mkdir(dirname($filename), 0755, true);
                    }
                    $commonFile = fopen(__DIR__ . '/../../resources/lang/' . $kLang . '/' . $b . '.php', 'w');
                    $common = [];
                    foreach ($collection->slice($file['length'][0] - 1, $file['length'][1] - 1)->toArray() as $key => $value) {
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
    }

    public function headingRow(): int
    {
        return 1;
    }
}
