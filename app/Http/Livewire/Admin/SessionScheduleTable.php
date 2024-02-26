<?php

namespace App\Http\Livewire\Admin;

use App\Models\SessionSchedule;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class SessionScheduleTable extends PowerGridComponent
{
    use ActionButton;
    use WithExport;

    public $unit_id;

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
     * @return Builder<\App\Models\SessionSchedule>
     */
    public function datasource(): Builder
    {
        return SessionSchedule::query()
            ->where('session_schedules.unit_id', $this->unit_id)
            ->join('members as member_1', function ($join) {
                $join->on('member_1.id', '=', 'session_schedules.member_1_id');
            })
            ->join('users as user_1', function ($join) {
                $join->on('user_1.id', '=', 'member_1.user_id');
            })
            ->join('passcodes', function ($join) {
                $join->on('passcodes.user_id', '=', 'user_1.id');
            })
            ->join('members as member_2', function ($join) {
                $join->on('member_2.id', '=', 'session_schedules.member_2_id');
            })
            ->select('session_schedules.*', 'member_1.name as member_1_name', 'member_2.name as member_2_name', 'passcodes.passcode as pass');
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
            ->addColumn('id_formatted', fn (SessionSchedule $model) => "PTR" . $model->id)
            ->addColumn('member_1_name')
            ->addColumn('member_2_name')
            ->addColumn('date')
            ->addColumn('date_formatted', fn (SessionSchedule $model) => Carbon::parse($model->date)->format('d/m/Y'))
            ->addColumn('shift')
            ->addColumn('status', function (SessionSchedule $model) {
                if ($model->status == "Belum Dilakukan") {
                    return '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-500 text-white">
                    Belum Dilakukan
                  </span>';
                } else if ($model->status == "Sedang Dilakukan") {
                    return '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-500 text-white">
                    Sedang Dilakukan
                  </span>';
                } else {
                    return '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-500 text-white">
                    Sudah Dilakukan
                  </span>';
                }
            })
            ->addColumn('pass');
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
            Column::make('Patroli ID', 'id_formatted', 'id'),
            Column::make('Member 1', 'member_1_name'),
            Column::make('Member 2', 'member_2_name'),
            Column::make('Tanggal', 'date_formatted', 'date')
                ->sortable(),
            Column::make('Shift', 'shift'),
            Column::make('Passcodes', 'pass'),
            Column::make('Status', 'status'),
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
            Filter::datepicker('date_formatted', 'date')
        ];
    }

    public function header(): array
    {
        return [
            Button::make('add', 'Add')
                ->class('bg-blue-500 cursor-pointer text-white px-3 py-2 rounded text-sm')
                ->openModal('admin.component.session-schedule.modal-add', ['unit_id' => $this->unit_id]),
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
     * PowerGrid SessionSchedule Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        return [
            Button::make('edit', 'Edit')
                ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 rounded text-sm'),

            Button::make('destroy', 'Delete')
                ->class('bg-red-500 cursor-pointer text-white px-3 py-2 rounded text-sm')
                ->openModal('admin.component.utils.modal-delete', ['id' => 'id', 'model' => 'App\Models\SessionSchedule'])
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
     * PowerGrid SessionSchedule Action Rules.
     *
     * @return array<int, RuleActions>
     */


    public function actionRules(): array
    {
        return [

            //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn ($session) => $session->status === "Sudah Dilakukan")
                ->hide(),

            Rule::button('edit')
                ->when(fn ($session) => $session->status === "Sedang Dilakukan")
                ->hide(),

            Rule::button('delete')
                ->when(fn ($session) => $session->status === "Sudah Dilakukan")
                ->hide(),

            Rule::button('delete')
                ->when(fn ($session) => $session->status === "Sedang Dilakukan")
                ->hide()
        ];
    }
}
