<x-livewire-tables::bs5.table.cell>
    {{ ($row->tenant->user->full_name) }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{ ($row->plan->name) }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{$row->plan->currency->currency_icon}} {{ $row->plan_amount}}
</x-livewire-tables::bs5.table.cell>


<x-livewire-tables::bs5.table.cell>
    {{ \Carbon\Carbon::parse($row->starts_at)->isoFormat('Do MMMM YYYY')}}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{ \Carbon\Carbon::parse($row->ends_at)->isoFormat('Do MMMM YYYY')}}
</x-livewire-tables::bs5.table.cell>


<x-livewire-tables::bs5.table.cell class="text-center">
    @if ($row->payment_type == 'Cash')
        <div class="form-check form-switch p-0">
            <label class="form-check form-switch form-check-custom form-check-solid form-switch-sm d-flex justify-content-center">
                <input class="form-check-input" type="checkbox" id="planStatus" name="is_active"
                       {{$row->status == 1   ? 'disabled checked'
                 : ''}}  data-id="{{$row->id}}" data-tenant="{{$row->tenant_id}}">
            </label>
        </div>
    @else<span class="badge badge-light-success">Received</span>
    @endif

</x-livewire-tables::bs5.table.cell>



