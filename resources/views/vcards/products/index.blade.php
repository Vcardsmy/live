<div class="card-body livewire-table">
    <livewire:vcard-product-table :vcard-id="$vcard->id"/>
    @include('vcards.products.create')
    @include('vcards.products.edit')
    @include('vcards.products.show')
</div>
@section('sub_menu_js')
    <script>
        let defaultServiceIconUrl = "{{ asset('assets/images/default_service.png') }}"
        let products = "{{__('messages.vcard.product')}}"
    </script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ asset('assets/js/vcards/products/products.js') }}"></script>
@endsection
