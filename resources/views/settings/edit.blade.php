@extends('layouts.app')
@section('title')
    {{ __('messages.settings') }}
@endsection
@section('content')
    @include('flash::message')
    <div class="col-12">
        @include('layouts.errors')
    </div>
    <div class="card mt-lg-0 mt-10">
        <div class="card-body pt-0 fs-6 py-8 px-8  px-lg-10 text-gray-700">
            @yield('section')
        </div>
    </div>
@endsection
