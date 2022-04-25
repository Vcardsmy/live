<x-livewire-tables::bs5.table.cell>
    <span class="">{{$row->plan->name}}</span>
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    <span class="">{{$row->plan->currency->currency_icon . '  ' .$row->plan_amount}}</span>
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    <span class="">{{Carbon\Carbon::parse($row->starts_at)->isoFormat('Do MMM, YYYY')}}</span>
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    <span class="">{{Carbon\Carbon::parse($row->ends_at)->isoFormat('Do MMM, YYYY')}}</span>
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    @if ($row->status == 1)
        <span class="badge bg-success">{{__('messages.common.active')}}</span>
    @else
        <span class="badge bg-danger">{{ __('messages.common.closed') }}</span>
    @endif
</x-livewire-tables::bs5.table.cell>
