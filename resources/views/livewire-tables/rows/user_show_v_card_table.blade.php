<x-livewire-tables::table.cell>
    <div class="d-flex">
        <div class="symbol me-5">
            <img src="{{ empty($row->template) ? asset('assets/images/default_cover_image.jpg')
            : $row->template->template_url }}" alt="" class="w-60">
        </div>
        <div class="d-flex align-items-center">
            {{ $row->name }}
        </div>
    </div>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->occupation }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    @if($row->status)
        <a id="vcardUrl{{$row->id}}" target="_blank" class="<text-primary></text-primary>"
           href="{{ route('vcard.defaultIndex').'/'.$row->url_alias }}">
            {{ route('vcard.defaultIndex').'/'.$row->url_alias }} </a>
    @else

        <span id="vcardUrl{{$row->id}}" target="_blank" class=""> {{ route('vcard.defaultIndex').'/'.$row->url_alias }} </span>
    @endif
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    @if ($row->status == 1)
    <span class="badge bg-success">{{ __('messages.common.active') }}</span>
    @else
    <span class="badge bg-danger">{{ __('messages.deactivate') }}</span>
    @endif
</x-livewire-tables::table.cell>
