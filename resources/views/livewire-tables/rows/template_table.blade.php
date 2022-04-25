<x-livewire-tables::bs5.table.cell>
    <span class="d-block fw-bold ">{{$row->name}}</span>

</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell class="text-center">
    <div class="d-flex">
        <a href="/{{$row->name}}" target="_blank">
            <div class="symbol me-5">
                <img src="{{$row->template_url}}" alt="" class="w-60">
            </div>
        </a>
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    @if($row->user_count)
        <span class="d-block fw-bold ">{{$row->user_count}}</span>
    @else
        <span class="d-block fw-bold ">{{__('messages.common.notUsed')}}</span>
    @endif
</x-livewire-tables::bs5.table.cell>

