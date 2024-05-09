<?php

namespace App\Http\Livewire\Admin;

use App\Models\Unit;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Responsive;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class UnitTable extends PowerGridComponent
{
    public $dataEdit;

    use ActionButton;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->dataEdit = collect([
            "fields" => [
                0 => ['name', 'Nama Unit', 'text']
            ],
            "model" => "App\Models\Unit"
        ]);

        return [
            Header::make()->showSearchInput(),

            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\Unit>
     */
    public function datasource(): Builder
    {
        $unit = Unit::query();

        return $unit;
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('name')
            ->addColumn('created_at')
            ->addColumn('created_at_formatted', fn (Unit $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->searchable()
                ->sortable(),

            Column::make('Name', 'name')
                ->searchable()
                ->sortable()
                ->headerAttribute(styleAttr: 'width: 75%'),
        ];
    }


    /**
     * PowerGrid Filters.
     *
     * @return array<int, Filter>
     */
    // public function filters(): array
    // {
    //     return [
    //         Filter::inputText('name'),
    //     ];
    // }


    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid Unit Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        return [
            Button::make('detail_subunit', 'Detail')
                ->class('bg-green-500 cursor-pointer text-white px-3 py-2.5 rounded text-sm')
                ->openModal('admin.component.unit.modal-subunit', ['id' => 'id']),

            Button::make('detail_shift', 'Detail')
                ->class('bg-green-500 cursor-pointer text-white px-3 py-2.5 rounded text-sm')
                ->openModal('admin.component.squad.modal-squad', ['id' => 'id']),

            Button::make('edit', 'Edit')
                ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 rounded text-sm')
                ->openModal('admin.component.utils.modal-edit', ['id' => 'id', "data" => $this->dataEdit]),


            Button::make('destroy', 'Delete')
                ->class('bg-red-500 cursor-pointer text-white px-3 py-2 rounded text-sm')
                ->openModal('admin.component.utils.modal-delete', ['id' => 'id', 'model' => 'App\Models\Unit'])

        ];
    }

    public function header(): array
    {
        return [
            Button::make('add', 'Add')
                ->class('bg-blue-500 cursor-pointer text-white px-3 py-2 rounded text-sm')
                ->openModal('admin.component.unit.modal-add', []),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Unit Action Rules.
     *
     * @return array<int, RuleActions>
     */


    public function actionRules(): array
    {
        return [

            //Hide button edit for ID 1
            Rule::button('detail_shift')
                ->when(fn ($unit) => $unit->name != "SKK")
                ->hide(),

            Rule::button('detail_subunit')
                ->when(fn ($unit) => ($unit->name == "SKK"))
                ->hide()
        ];
    }
}
