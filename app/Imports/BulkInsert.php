<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class BulkInsert implements ToModel
{
    protected $model;
    protected $column_mapping;

    public function __construct($model, $data)
    {
        $this->model = $model;
        $this->column_mapping = $data;
    }

    public function model(array $row)
    {
        $data = [];
        $modelclass = app($this->model);

        foreach ($this->column_mapping as $key => $value) {
            $data[$value] = $row[$key];
        }
        return new $modelclass($data);
    }
}
