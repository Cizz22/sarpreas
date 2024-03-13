<?php

namespace App\Http\Livewire\Admin;

use App\Models\Subunit;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

use function PHPSTORM_META\map;

final class SubunitTable extends PowerGridComponent
{
    use ActionButton;

    public $unit_id;
    public $dataEdit;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {


        $coordinator = User::where('roles', 'coordinator')
            ->with('member')
            ->get();

        $this->dataEdit = collect([
            "fields" => [
                0 => ['name', 'Nama Subunit', 'text'],
                1 => [
                    'coordinator_id',
                    'Koordinator',
                    'select',
                    $coordinator,
                    'subunit'
                ],
            ],
            "model" => "App\Models\Subunit"
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
     * @return Builder<\App\Models\Subunit>
     */
    public function datasource(): Builder
    {
        $subunit = Subunit::query()
            ->where('subunits.unit_id', $this->unit_id)
            ->leftjoin('members', function ($q) {
                $q->on("members.id", "subunits.coordinator_id");
            })
            ->select("subunits.*", "members.name as coordinator", "members.no_hp");

        return $subunit;
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
            ->addColumn('coordinator')
            ->addColumn('detail_location')
            ->addColumn('no_hp')
            ->addColumn('created_at')
            ->addColumn('created_at_formatted', fn (Subunit $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
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
                ->sortable()
                ->hidden(),
            Column::make('Nama Subunit', 'name')
                ->searchable()
                ->sortable(),
            Column::make('Nama Koordinator', 'coordinator')
                ->searchable()
                ->sortable(),
            Column::make('Lokasi', 'detail_location')
                ->searchable()
                ->sortable(),
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
    //         Filter::datepicker('created_at_formatted', 'created_at'),
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
     * PowerGrid Subunit Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        return [
            Button::make('members', 'Subunit Members')
                ->class('bg-green-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
                ->openModal('admin.component.subunit.modal-subunit-member', ['id' => 'id']),

            Button::make('edit', 'Edit')
                ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 rounded text-sm')
                ->openModal('admin.component.utils.modal-edit', ['id' => 'id', "data" => $this->dataEdit]),


            Button::make('destroy', 'Delete')
                ->class('bg-red-500 cursor-pointer text-white px-3 py-2 rounded text-sm')
                ->openModal('admin.component.utils.modal-delete', ['id' => 'id', 'model' => 'App\Models\Subunit'])
        ];
    }

    public function header(): array
    {
        return [
            Button::make('add', 'Add')
                ->class('bg-blue-500 cursor-pointer text-white px-3 py-2 rounded text-sm')
                ->openModal('admin.component.subunit.modal-add', ['unit_id' => $this->unit_id]),
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
     * PowerGrid Subunit Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($subunit) => $subunit->id === 1)
                ->hide(),
        ];
    }
    */
}
