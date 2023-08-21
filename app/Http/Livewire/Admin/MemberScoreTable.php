<?php

namespace App\Http\Livewire\Admin;

use App\Models\ScoreMember;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class MemberScoreTable extends PowerGridComponent
{
    use ActionButton;

    public $member_id;

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
     * @return Builder<\App\Models\ScoreMember>
     */
    public function datasource(): Builder
    {
        $scoreMember = ScoreMember::query()
            ->where('member_id', $this->member_id)
            ->join('subunits', function ($join) {
                $join->on('subunits.id', '=', 'score_members.subunit_id');
            })
            ->join('members', function ($join) {
                $join->on('members.id', '=', 'score_members.coordinator_id');
            })
            ->join('presensi_members', function ($join) {
                $join->on('presensi_members.member_id', '=', 'score_members.member_id')
                    ->where('presensi_members.tanggal_presensi', '=', 'score_members.tanggal_penilaian');
            })
            ->select('score_members.*', 'subunits.name as subunit_name', 'members.name as coordinator_name', 'presensi_members.status as presensi');
        return $scoreMember;
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
            ->addColumn('coordinator_name')
            ->addColumn('subunit_name')
            ->addColumn('prensensi')
            ->addColumn('tanggal_penilaian')
            ->addColumn('tanggal_penilaian_formatted', fn (ScoreMember $model) => Carbon::parse($model->tanggal_penilaian)->format('d/m/Y'))
            ->addColumn('sum_score', fn (ScoreMember $model) => $model->sumScore());
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

            Column::make('Nama Coordinator', 'coordinator_name')
                ->searchable()
                ->sortable(),

            Column::make('Subunit', 'subunit_name')
                ->searchable(),

            Column::make('Tanggal Penilaian', 'tanggal_penilaian_formatted', 'tanggal_penilaian')
                ->searchable(),

            Column::make('Total Skor', 'sum_score')
                ->searchable()
                ->sortable(),

            Column::make('Status Presensi', 'presensi')
                ->searchable()
                ->sortable(),
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
            Filter::datepicker('tanggal_penilaian_formatted', 'tanggal_penilaian'),
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
     * PowerGrid ScoreMember Action Buttons.
     *
     * @return array<int, Button>
     */

    /*
    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('score-member.edit', ['score-member' => 'id']),

           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('score-member.destroy', ['score-member' => 'id'])
               ->method('delete')
        ];
    }
    */

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid ScoreMember Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($score-member) => $score-member->id === 1)
                ->hide(),
        ];
    }
    */
}
