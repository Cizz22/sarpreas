<?php

namespace App\Imports;

use App\Imports\Subunit\IndoorSheet;
use App\Imports\Subunit\OutdoorImport;
use App\Imports\Subunit\SKKImport;
use App\Models\SubunitMember;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;

class SubunitMemberImport implements WithMultipleSheets
{
    use WithConditionalSheets;

    public function conditionalSheets(): array
    {
        return [
            'Member Subunit Indoor' => new IndoorSheet(),
            'SKK' => new SKKImport(),
            'data input member outdoor' => new OutdoorImport(),
            'Mobil' => new MobilImport()
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }
}
