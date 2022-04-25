<x-livewire-tables::bs5.table.cell>
    <span class="">{{$row->vcard->name}}</span>
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    <span class="">{{$row->name}}</span>
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    <a href="mailto:{{$row->email}}"
       class="event-name text-center pt-3 mb-0">{{$row->email}}</a>
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    @if($row->phone)
        {{ $row->phone }}
    @else
        {{'N/A'}}
    @endif
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    <span class="">{{ Carbon\Carbon::parse($row->created_at)->isoFormat('Do MMM, YYYY') }}</span>
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    <a title=" {{__('messages.common.view')}}"
       class="btn text-center btn-icon btn-bg-light btn-active-color-primary enquiries-view-btn btn-sm ms-1"
       href="javascript:void(0)" data-id="{{$row->id}}">
<span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                             version="1.1">
                        <path d="M12.01 20c-5.065 0-9.586-4.211-12.01-8.424 2.418-4.103 6.943-7.576 12.01-7.576 5.135 0 9.635 3.453 11.999 7.564-2.241 4.43-6.726 8.436-11.999 8.436zm-10.842-8.416c.843 1.331 5.018 7.416 10.842 7.416 6.305 0 10.112-6.103 10.851-7.405-.772-1.198-4.606-6.595-10.851-6.595-6.116 0-10.025 5.355-10.842 6.584zm10.832-4.584c2.76 0 5 2.24 5 5s-2.24 5-5 5-5-2.24-5-5 2.24-5 5-5zm0 1c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4z"
                              fill="#000000" fill-rule="nonzero"/>
                        </svg></span> </a>
</x-livewire-tables::bs5.table.cell>

