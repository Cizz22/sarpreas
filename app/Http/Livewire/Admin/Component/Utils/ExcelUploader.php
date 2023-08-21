<?php

namespace App\Http\Livewire\Admin\Component\Utils;

use App\Imports\BulkInsert;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\Modal;
use LivewireUI\Modal\ModalComponent;
use Maatwebsite\Excel\Facades\Excel;

class ExcelUploader extends ModalComponent
{
    use WithFileUploads;

    public $data;
    public $excel;
    public $model;

    public function mount($data, $model)
    {
        $this->data = $data;
        $this->model = $model;
    }

    public function submit()
    {
        $this->validate([
            'excel' => 'required|mimes:xlsx,xls',
        ]);

        $excelDataImport = new BulkInsert($this->model, $this->data);

        Excel::import($excelDataImport, $this->excel);

        $this->closeModalWithEvents([
            'pg:eventRefresh-default',
        ]);
    }

    public function render()
    {
        return view('livewire.admin.component.utils.excel-uploader');
    }
}
