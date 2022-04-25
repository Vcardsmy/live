@extends('layouts.app')
@section('title')
    {{__('messages.state.states')}}
@endsection
@section('content')
    @include('flash::message')
    <div class="post flex-column-fluid" id="kt_post">
        <div class="card mt-lg-0 mt-10">
            <div class="card-body pt-0 livewire-table">
                <livewire:state-table/>
            </div>
            @include('sadmin.states.add_modal')
            @include('sadmin.states.edit_modal')
        </div>
    </div>
@endsection
