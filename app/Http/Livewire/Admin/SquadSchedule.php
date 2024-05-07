<?php

namespace App\Http\Livewire\Admin;

use App\Models\IntervalSchedule;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class SquadSchedule extends PowerGridComponent
{
    use ActionButton;
    public $squad_id;

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
     * @return Builder<\App\Models\IntervalSchedule>
     */
    public function datasource(): Builder
    {
        $interval = IntervalSchedule::query()
            ->where('squad_id', $this->squad_id)
            ->whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)
            ->join('shift_schedules', function ($join) {
                $join->on('shift_schedules.id', '=', 'interval_schedules.shift_schedule_id');
            })
            ->select('interval_schedules.id', 'interval_schedules.date', 'shift_schedules.start_time', 'shift_schedules.end_time', 'shift_schedules.type');


        return $interval;
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
            ->addColumn('type')
            ->addColumn('date')
            ->addColumn('start_time')
            ->addColumn('end_time');
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
            Column::make('Shift', 'type'),
            Column::make('Tanggal', 'date'),
            Column::make('Waktu Mulai', 'start_time'),
            Column::make('Waktu Selesai', 'end_time'),
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

    // public function header(): array
    // {
    //     return [
    //         Button::make('add', 'Add')
    //             ->class('bg-blue-500 cursor-pointer text-white px-3 py-2 rounded text-sm')
    //             ->openModal('admin.component.squad.modal-scheduling', ['squad_id' => $this->squad_id]),
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
     * PowerGrid IntervalSchedule Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
       return [
           Button::make('detail', 'Detail')
               ->class('bg-green-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm'),
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
     * PowerGrid IntervalSchedule Action Rules.
     *
     * @return array<int, RuleActions>
     */


    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('detail')
                ->when(fn ($row) => !$row->has('sessionSchedule')->first())
                ->hide(),
        ];
    }

}
