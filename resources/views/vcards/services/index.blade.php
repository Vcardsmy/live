<div class="card-body livewire-table">
    <livewire:vcard-service-table  :vcard-id="$vcard->id"/>
    @include('vcards.services.create')
    @include('vcards.services.edit')
    @include('vcards.services.show')
</div>
@section('sub_menu_js')
    <script>
        let defaultServiceIconUrl = "{{ asset('assets/images/default_service.png') }}"
        let vcard_service = "{{__('messages.vcard.vcard_service')}}"
        let id = '{{ $vcard->id }}'
    </script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ asset('assets/js/vcards/services/services.js') }}"></script>
@endsection
