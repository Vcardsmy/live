@extends('layouts.app')
@section('title')
    {{__('messages.vcards')}}
@endsection
@section('content')
    @include('layouts.errors')
    <div class="card mt-lg-0 mt-5">
        <div class="card-body pt-0 livewire-table">
            <livewire:user-vcard-table/>
        </div>
        @include('layouts.templates.actions')
        @include('vcards.templates.templates')
        @include('vcards.templates.analytics')
    </div>
@endsection
