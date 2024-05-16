<?php

namespace App\Http\Livewire\Admin;

use App\Models\Report;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class ReportSKKDetailTable extends PowerGridComponent
{
    use ActionButton;

    public $session_schedule_id;

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
            // Exportable::make('export')
            //     ->striped()
            //     ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
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
     * @return Builder<\App\Models\Report>
     */
    public function datasource(): Builder
    {
        $report = Report::query()
            ->where('session_schedule_id', $this->session_schedule_id)
            ->leftjoin('locations', function ($join) {
                $join->on('locations.id', '=', 'reports.location_id');
            })
            ->select('reports.*', 'locations.name as location_name');

        return $report;
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
            ->addColumn('location_name')
            ->addColumn('interval_time')
            ->addColumn('situation')
            ->addColumn('latitude')
            ->addColumn('longitude')
            ->addColumn('additional_information')
            ->addColumn('created_at');
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
                ->hidden(),
            Column::make('Location', 'location_name')
                ->searchable()
                ->sortable(),
            Column::make('Interval Time', 'interval_time')
                ->searchable()
                ->sortable(),
            Column::make('Situation', 'situation')
                ->searchable()
                ->sortable(),
            Column::make('Additional Information', 'additional_information'),
            Column::make('Created at', 'created_at')
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
     * PowerGrid Report Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        return [
            Button::add('map')
            ->render(function (Report $report) {
                    return Blade::render(<<<HTML
         <a href="https://maps.google.com/?q={$report->latitude},{$report->longitude}" target="_blank">
            <button class="bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm">Map</button>
         </a>
        HTML);
                }),
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

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($report) => $report->id === 1)
                ->hide(),
        ];
    }
    */
}
