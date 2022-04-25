@extends('layouts.app')
@section('title')
{{__('messages.cash_payment')}}
@endsection
@section('content')
    @include('flash::message')
    <div class="post flex-column-fluid" id="kt_post">
        <div class="card mt-lg-0 mt-10">
            <div class="card-body pt-0 livewire-table" >
                <livewire:cash-payment-table/>
            </div>
        </div>
    </div>
@endsection
