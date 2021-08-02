<?php

namespace DevNta\Messages\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class MessageFileImport implements WithMultipleSheets, SkipsUnknownSheets
{

    /**
     * @return array
     */
    public function sheets(): array
    {

        $arrLanguage = $this->mapLanguage(config('nta_message.sheet.language'));
        $arrRule = $this->mapRule(config('nta_message.sheet.validation'));
        return array_merge(
            $arrLanguage,
            $arrRule
        );
    }

    /**
     * @param int|string $sheetName
     */
    public function onUnknownSheet($sheetName)
    {
        info("Sheet {$sheetName} was skipped");
    }

    /**
     * @param $array
     * @return mixed
     */
    public function mapLanguage($array)
    {
        return array_reduce($array, function ($init, $item) {
            $init[$item] = new LangSheetImport($item);
            return $init;
        }, []);
    }

    /**
     * @param $array
     * @return mixed
     */
    public function mapRule($array)
    {
        return array_reduce($array, function ($init, $item) {
            $init[$item] = new ValidationSheetImport($item);
            return $init;
        }, []);
    }

}
