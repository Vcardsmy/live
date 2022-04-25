@extends('layouts.app')
@section('title')
    {{__('messages.vcard.edit_vcard')}}
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
    </div><br><br>
@endsection
@section('content')
    <div class="post flex-column-fluid mt-lg-10" id="kt_post">
         @if(Session::has('success'))<p class="alert alert-success">{{ getSuccessMessage(Request::query('part')).Session::get('success') }}</p>@endif
        <div class="d-flex flex-column flex-lg-row">
            <div class="flex-lg-row-fluid mb-10 mb-lg-0">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.errors')
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body pb-1 pt-5">
                        @include('vcards.sub_menu')
                    </div>
                </div>
                <div class="card">
                    {{ Form::hidden('is_true', Request::query('part') == 'business_hours',['id' => 'vcardCreateEditIsTrue']) }}
                    @if($partName != 'services' && $partName != 'testimonials' && $partName != 'products' && $partName != 'gallery')
                        <div class="card-body p-12">
                            {!! Form::open(['route' => ['vcards.update', $vcard->id], 'id' => 'editForm', 'method' => 'put', 'files' => 'true']) !!}
                            @include('vcards.fields')
                            {{ Form::close() }}
                        </div>
                    @else
                        @if($partName == 'services')
                            @include('vcards.services.index')
                        @elseif($partName == 'products')
                            @include('vcards.products.index')
                        @elseif($partName == 'gallery')
                            @include('vcards.gallery.index')
                        @else
                            @include('vcards.testimonials.index')

                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
