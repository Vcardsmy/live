@extends('layouts.app')
@section('title')
    {{__('messages.vcard.new_vcard')}}
@endsection
@section('header_toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                 data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                 class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">@yield('title')</h1>
            </div>
            <div class="d-flex align-items-center py-1 ms-auto">
                <a href="{{ route('vcards.index') }}"
                   class="btn btn-sm btn-primary">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="post flex-column-fluid mt-lg-10" id="kt_post">
        <div class="d-flex flex-column flex-lg-row">
            <div class="flex-lg-row-fluid mb-10 mb-lg-0 ">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.errors')
                    </div>
                </div>
                <div class="card">
                    <div class="card-body p-12">
                        {{ Form::hidden('is_true', Request::query('part') == 'business_hours',['id' => 'vcardCreateEditIsTrue']) }}
                        {!! Form::open(['route' => 'vcards.store','files' => 'true']) !!}
                        @include('vcards.fields')
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let defaultProfileUrl = "{{ asset('web/media/avatars/150-26.jpg') }}";
        let defaultCoverUrl = "{{ asset('assets/images/default_cover_image.jpg') }}";
        let defaultServiceIconUrl = "{{ asset('assets/images/default_service.png') }}";
        let lang = "{{checkLanguageSession()}}";
        {{--let defaultServiceIconUrl = "{{ asset('assets/images/default_service.png') }}";--}}
    </script>
    <script src="{{ asset('assets/js/vcards/create-edit.js') }}"></script>
@endsection

