@extends('layouts.app')
@section('title')
    {{__('messages.city.cities')}}
@endsection
@section('content')
    @include('flash::message')
    <div class="post flex-column-fluid" id="kt_post">
        <div class="card mt-lg-0 mt-10">
            <div class="card-body pt-0 livewire-table">
                <livewire:city-table/>
            </div>
            @include('sadmin.cities.add_modal')
            @include('sadmin.cities.edit_modal')
        </div>
    </div>
@endsection

