<?php

namespace App\Http\Livewire\Admin;

use App\Models\Member;
use App\Models\SubunitMember;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class SubunitMemberTable extends PowerGridComponent
{
    use ActionButton;
    public $subunit_id;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

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
     * @return Builder<\App\Models\Member>
     */
    public function datasource(): Builder
    {
        $member = SubunitMember::query()->where('subunit_id', $this->subunit_id)
            ->join('members', function ($q) {
                $q->on('members.id', 'subunit_members.memberable_id')
                    ->where('subunit_members.memberable_type', 'App\Models\Member');
            })->select("members.*");

        return $member;
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
            ->addColumn('no_hp');
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

            Column::make('Name', 'name')
                ->searchable()
                ->sortable(),

            Column::make('No HP', 'no_hp')
                ->searchable()
                ->sortable(),
        ];
    }




    public function header(): array
    {
        return [
            Button::make('add', 'Add')
                ->class('bg-blue-500 cursor-pointer text-white px-3 py-2 rounded text-sm')
                ->openModal('admin.component.subunit.modal-add-subunit-member', ['subunit_id' => $this->subunit_id]),
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
     * PowerGrid Member Action Buttons.
     *
     * @return array<int, Button>
     */

     public function actions(): array
     {
         return [
             Button::make('detail', 'Detail')
                 ->class('bg-green-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
                 ->openModal('admin.component.coordinator.modal-passcode', ['id' => 'id']),

             Button::make('edit', 'Edit')
                 ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm'),


             Button::make('destroy', 'Delete')
                 ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')

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
     * PowerGrid Member Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($member) => $member->id === 1)
                ->hide(),
        ];
    }
    */
}
