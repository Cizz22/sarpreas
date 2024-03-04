<?php

namespace App\Http\Livewire;

use App\Models\Squad;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class SquadTable extends PowerGridComponent
{
    use ActionButton;

    public $dataEdit, $unit_id;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        // $this->showCheckBox();
        // dd($this->unit_id);

        $this->dataEdit = collect([
            "fields" => [
                0 => ['name', 'Nama Squad', 'text'],
            ],
            "model" => "App\Models\Squad"
        ]);

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
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
     * @return Builder<\App\Models\Squad>
     */
    public function datasource(): Builder
    {
        return Squad::query()
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'squads.user_id');
            })
            ->join('passcodes', function ($join) {
                $join->on('passcodes.user_id', '=', 'users.id');
            })
            ->select('squads.id', 'squads.name as name', 'passcodes.passcode as passcode');
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
            ->addColumn('passcode')
            ->addColumn('name');
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
            Column::make('Name', 'name')
                ->searchable()
                ->sortable()
                ->headerAttribute(styleAttr: 'width: 60%'),

            Column::make('Passcode', 'passcode')
                ->searchable()
                ->sortable()
                ->headerAttribute(styleAttr: 'width: 20%')
        ];
    }

    /**
     * PowerGrid Filters.
     *
     * @return array<int, Filter>
     */
    public function filters(): array
    {
        return [
            Filter::inputText('name'),
            // Filter::datepicker('created_at_formatted', 'created_at'),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid Squad Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
        return [
            Button::make('members', 'Squad Members')
                ->class('bg-green-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
                ->openModal('admin.component.squad.modal-squad-member', ['id' => 'id', 'unit_id' => $this->unit_id]),

            Button::make('penjadwalan', 'Penjadwalan')
                ->class('bg-blue-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
                ->openModal('admin.component.squad.modal-squad-schedule', ['id' => 'id']),

            // Button::make('edit', 'Edit')
            //     ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 rounded text-sm')
            //     ->openModal('admin.component.utils.modal-edit', ['id' => 'id', "data" => $this->dataEdit]),

            // Button::make('destroy', 'Delete')
            //     ->class('bg-red-500 cursor-pointer text-white px-3 py-2 rounded text-sm')
            //     ->openModal('admin.component.utils.modal-delete', ['id' => 'id', 'model' => 'App\Models\Squad'])
        ];
    }

    public function header(): array
    {
        return [
            Button::make('add', 'Add')
                ->class('bg-blue-500 cursor-pointer text-white px-3 py-2 rounded text-sm')
                ->openModal('admin.component.squad.modal-add', ['unit_id' => $this->unit_id]),
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
     * PowerGrid Squad Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($squad) => $squad->id === 1)
                ->hide(),
        ];
    }
    */
}
