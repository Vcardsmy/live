<?php

namespace App\Http\Livewire;


use App\Models\Vcard;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ScheduleAppointment;

class ScheduleAppointmentTable extends LivewireTableComponent
{
    public $paginationTheme = 'bootstrap-5';
    public string $primaryKey = 'schedule_appointment_id';
    public string $defaultSortColumn = 'created_at';
    public string $defaultSortDirection = 'desc';
    protected $listeners = ['refresh' => '$refresh'];
    protected string $pageName = 'schedule-appointment-table';
    
    public function columns(): array
    {
        return [
            Column::make(__('messages.vcard.vcard_name'), 'vcard.name')
                ->sortable(function (Builder $query, $direction) {
                    return $query->orderBy(Vcard::select('name')->whereColumn('id', 'vcard_id'),
                        $direction);
                })->searchable(),
            Column::make(__('messages.common.name'), "name")
                ->sortable()->searchable(),
            Column::make(__('messages.common.email'), "email")
                ->sortable()->searchable(),
            Column::make(__('messages.common.phone'), "phone")
                ->sortable()->searchable(),
            Column::make(__('messages.date'), "date")
                ->sortable()->searchable(),
            Column::make(__('messages.from_time'), "from_time")
                ->sortable()->searchable()->addClass('justify-content-center d-flex'),
            Column::make(__('messages.to_time'), "to_time")
                ->sortable()->searchable()->addClass('w-100px '),
        ];
    }

    public function query(): Builder
    {
        $vcardIds = Vcard::whereTenantId(getLogInTenantId())->pluck('id')->toArray();

        return ScheduleAppointment::with('vcard')->whereIn('vcard_id',$vcardIds);
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.schedule_appointment_table';
    }
}
