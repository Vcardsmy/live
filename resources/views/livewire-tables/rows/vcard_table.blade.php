<x-livewire-tables::bs5.table.cell>
    <div class="text-nowrap d-flex align-items-center">
        <div class="symbol  symbol-50px overflow-hidden me-3">
            <div class="symbol-label">

                @if(empty($row->template))
                    <img src="assets/images/default_cover_image.jpg">
                @else
                    <img src="{{$row->template->template_url}}" alt=""
                         class="w-100 object-cover">
                @endif

            </div>
        </div>
        <div class="d-inline-block align-top ">
            <span class="text-primary d-block">{{$row->name}}</span>
            <span class="d-block">{{$row->occupation}}</span>
        </div>
    </div>

</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell class="text-center">
    <span class=" d-block">{{$row->tenant->tenant_username}}</span>

</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    @if ($row->status == 1)
        <a href="{{route('vcard.defaultIndex').'/'. $row->url_alias}}" id="vcardUrl{{$row->id}}"
           target="_blank" class="text-primary-800">{{route('vcard.defaultIndex').'/'. $row->url_alias}}</a>
        <button class="btn btn-active-color-primary btn-icon btn-sm btn-outline-light copy-clipboard"
                data-id="{{ $row->id }}" title="{{'copy'}}">
        <span class="svg-icon svg-icon-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path opacity="0.5"
                      d="M18 2H9C7.34315 2 6 3.34315 6 5H8C8 4.44772 8.44772 4 9 4H18C18.5523 4 19 4.44772 19 5V16C19 16.5523 18.5523 17 18 17V19C19.6569 19 21 17.6569 21 16V5C21 3.34315 19.6569 2 18 2Z"
                      fill="black"></path>
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M14.7857 7.125H6.21429C5.62255 7.125 5.14286 7.6007 5.14286 8.1875V18.8125C5.14286 19.3993 5.62255 19.875 6.21429 19.875H14.7857C15.3774 19.875 15.8571 19.3993 15.8571 18.8125V8.1875C15.8571 7.6007 15.3774 7.125 14.7857 7.125ZM6.21429 5C4.43908 5 3 6.42709 3 8.1875V18.8125C3 20.5729 4.43909 22 6.21429 22H14.7857C16.5609 22 18 20.5729 18 18.8125V8.1875C18 6.42709 16.5609 5 14.7857 5H6.21429Z"
                      fill="black"></path>
            </svg>
        </span>
        </button>
    @else
        <span id="vcardUrl{{$row->id}}" target="_blank"
              class=""> {{route('vcard.defaultIndex').'/'. $row->url_alias}} </span>
    @endif
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <a href="{{ route('sadmin.vcard.analytics',
                                $row->id)}}" data-id="{{$row->id}}"><span class="svg-icon svg-icon-primary svg-icon-2x"><svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z"
              fill="#000000" fill-rule="nonzero"/>
        <path d="M8.7295372,14.6839411 C8.35180695,15.0868534 7.71897114,15.1072675 7.31605887,14.7295372 C6.9131466,14.3518069 6.89273254,13.7189711 7.2704628,13.3160589 L11.0204628,9.31605887 C11.3857725,8.92639521 11.9928179,8.89260288 12.3991193,9.23931335 L15.358855,11.7649545 L19.2151172,6.88035571 C19.5573373,6.44687693 20.1861655,6.37289714 20.6196443,6.71511723 C21.0531231,7.05733733 21.1271029,7.68616551 20.7848828,8.11964429 L16.2848828,13.8196443 C15.9333973,14.2648593 15.2823707,14.3288915 14.8508807,13.9606866 L11.8268294,11.3801628 L8.7295372,14.6839411 Z"
              fill="#000000" fill-rule="nonzero" opacity="0.3"/>
    </g>
</svg><!--end::Svg Icon--></span></a>

</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <div class="badge badge-light">
        <div>{{ Carbon\Carbon::parse($row->created_at)->isoFormat('Do MMM, YYYY') }}</div>
    </div>

</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    @if ($row->status == 1)
        <span class="badge bg-success">Active</span>
    @else
        <span class="badge bg-danger">Deactive</span>
    @endif
</x-livewire-tables::bs5.table.cell>
