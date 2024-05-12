<?php

namespace App\Http\Livewire\Guest\Component;

use App\Models\CarBooking;
use Asantibanez\LivewireCalendar\LivewireCalendar;
use Illuminate\Support\Collection;
use Livewire\Component;

class CarCalender extends LivewireCalendar
{
    public function events(): Collection
    {
        return CarBooking::query()
            ->whereDate('booking_date', '>=', $this->gridStartsAt)
            ->whereDate('booking_date', '<=', $this->gridEndsAt)
            ->get()
            ->map(function (CarBooking $model) {
                return [
                    'id' => $model->id,
                    'title' => $model->organization_name,
                    'description' => "$model->start_time > $model->end_time",
                    'date' => $model->booking_date,
                ];
            });
    }
}
