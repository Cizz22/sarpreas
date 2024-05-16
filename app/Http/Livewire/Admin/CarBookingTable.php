<?php

namespace App\Http\Livewire\Admin;

use App\Models\CarBooking;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class CarBookingTable extends PowerGridComponent
{
    use ActionButton, WithExport;

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
     * @return Builder<\App\Models\CarBooking>
     */
    public function datasource(): Builder
    {
        return CarBooking::query();
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
    // 'car_id',
    // 'booking_code',
    // 'organization_name',
    // 'license_plate',
    // 'person_in_charge_name',
    // 'person_in_charge_phone_number',
    // 'person_in_charge_email',
    // 'booking_date',
    // 'status',
    // 'supporting_documents',
    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('booking_code')
            ->addColumn('car', fn (CarBooking $model) => strtolower(e($model->car->name)))
            ->addColumn('organization_name')
            ->addColumn('person_in_charge_name')
            ->addColumn('person_in_charge_phone_number')
            ->addColumn('booking_date', fn (CarBooking $model) => Carbon::parse($model->booking_date)->format('d/m/Y H:i:s'))
            ->addColumn('status');
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
            Column::make('Booking Code', 'booking_code')
                ->searchable(),
            Column::make('Mobil', 'car'),
            Column::make('Nama Organisasi', 'organization_name'),
            Column::make('Nama Penanggungjawab', 'person_in_charge_name'),
            Column::make('Kontak Penanggungjawab', 'person_in_charge_phone_number'),
            Column::make('Tanggal Booking', 'booking_date'),
            Column::make('Status', 'status')
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
            Filter::datepicker('created_at_formatted', 'created_at'),
        ];
    }

    public function actions(): array
    {
        return [
            // Button::make('Dokument', 'Passcode')
            //     ->class('bg-green-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm'),
            Button::make('detail', 'Detail')
                ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 rounded text-sm')
                ->openModal('admin.component.car-booking.modal-detail', ['carBookingId' => 'id']),

            Button::make('terima', 'Terima')
                ->class('bg-green-500 cursor-pointer text-white px-3 py-2.5 rounded text-sm')
                ->openModal('admin.component.car-booking.modal-accept', ['car_booking_id' => 'id', 'type' => "accept"]),

            Button::make('tolak', 'Tolak')
                ->class('bg-red-500 cursor-pointer text-white px-3 py-2 rounded text-sm')
                ->openModal('admin.component.car-booking.modal-accept', ['car_booking_id' => 'id', 'type' => "reject"]),

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
     * PowerGrid CarBooking Action Buttons.
     *
     * @return array<int, Button>
     */

    /*
    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('car-booking.edit', ['car-booking' => 'id']),

           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('car-booking.destroy', ['car-booking' => 'id'])
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
     * PowerGrid CarBooking Action Rules.
     *
     * @return array<int, RuleActions>
     */


    public function actionRules(): array
    {
        return [

            //Hide button edit for ID 1
            Rule::button('terima')
                ->when(fn ($car_booking) => $car_booking->status == 'approved')
                ->hide(),

            Rule::button('tolak')
                ->when(fn ($car_booking) => $car_booking->status == 'approved')
                ->hide(),
        ];
    }
}
