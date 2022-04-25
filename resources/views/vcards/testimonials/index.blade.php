<div class="card-body livewire-table">
    <livewire:vcard-testimonial-table :vcard-id="$vcard->id" />
    @include('vcards.testimonials.create')
    @include('vcards.testimonials.edit')
    @include('vcards.testimonials.show')
</div>
@section('sub_menu_js')
    <script>
        let vcard_testimonial = "{{__('messages.vcard.testimonial')}}";
    </script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ asset('assets/js/vcards/testimonials/testimonials.js') }}"></script>
@endsection
