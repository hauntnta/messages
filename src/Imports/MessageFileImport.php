<?php

namespace DevNta\Messages\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MessageFileImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new LangSheetImport(),
            new ValidationSheetImport()
        ];
    }
}
