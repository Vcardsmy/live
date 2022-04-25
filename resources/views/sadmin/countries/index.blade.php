@extends('layouts.app')
@section('title')
    {{__('messages.country.countries')}}
@endsection
@section('content')
    @include('flash::message')
    <div class="post flex-column-fluid" id="kt_post">
        <div class="card mt-lg-0 mt-10">
            <div class="card-body pt-0 livewire-table ">
                <livewire:country-table/>
            </div>
            @include('sadmin.countries.add_modal')
            @include('sadmin.countries.edit_modal')
        </div>
    </div>
@endsection
