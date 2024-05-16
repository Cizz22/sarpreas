<?php

namespace App\Http\Controllers;

use App\Imports\SubunitMemberImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TestImport extends Controller
{
    public function index()
    {
        $import = new SubunitMemberImport();
        $import->onlySheets('outdoor');

        $data = Excel::toCollection($import, public_path('data/data2.xlsx'));

        dd($data);
    }
}
