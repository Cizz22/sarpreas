<?php

namespace App\Http\Livewire\Admin;

use App\Models\Report;
use App\Models\SessionSchedule;
use Carbon\Carbon as CarbonCarbon;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class ReportSKKTable extends PowerGridComponent
{

    use WithExport;
    use ActionButton;
    // public string $sortField = 'total_score';
    // public string $sortDirection = 'desc';

    public $dateInput, $shiftInput, $reguInput;

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
        $session = SessionSchedule::query()
            ->where('session_schedules.unit_id', $this->unitInput)
            ->where('session_schedules.status', '!=', 'Belum Dilakukan')
            ->whereDate('session_schedules.date', $this->dateInput);

        if ($this->shiftInput != 'all') {
            $session->where('session_schedules.shift', $this->shiftInput);
        }

        $session->join('members as member_1', function ($join) {
            $join->on('member_1.id', '=', 'session_schedules.member_1_id');
        })
            ->join('members as member_2', function ($join) {
                $join->on('member_2.id', '=', 'session_schedules.member_2_id');
            })
            ->select('session_schedules.*', 'member_1.name as member_1_name', 'member_2.name as member_2_name');

        return $session;
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
            ->addColumn('member_1_name')
            ->addColumn('member_2_name')
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
            });
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
            Column::make('ID', 'id'),
            Column::make('Member 1', 'member_1_name'),
            Column::make('Member 2', 'member_2_name'),
            Column::make('Shift', 'shift'),
            Column::make('Status', 'status'),
        ];
    }

    // /**
    //  * PowerGrid Filters.
    //  *
    //  * @return array<int, Filter>
    //  */
    // public function filters(): array
    // {
    //     return [
    //         Filter::select('status', 'status')
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
     * PowerGrid Report Action Buttons.
     *
     * @return array<int, Button>
     */
    public function actions(): array
    {
        return [
            Button::make('detail', 'Detail')
                ->class('bg-green-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
                ->openModal('admin.component.report.modal-skk-detail', ['id' => 'id'])
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
     * PowerGrid Report Action Rules.
     *
     * @return array<int, RuleActions>
     */

    public function actionRules(): array
    {
        return [

            //Hide button edit for ID 1
            Rule::button('detail')
                ->when(fn ($session) => $session->status === "Belum Dilakukan")
                ->hide(),
        ];
    }
}
