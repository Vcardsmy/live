@extends('layouts.app')
@section('title')
    {{__('messages.front_cms.front_cms')}}
@endsection
@section('content')
    <div class="post flex-column-fluid" id="kt_post">
        <div class="d-flex flex-column flex-lg-row">
            <div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
                @include('flash::message')
                @include('layouts.errors')
                <div class="card mt-lg-0 mt-10">
                    <div class="card-body p-12">
                        {!! Form::open(['route' => 'setting.front.cms.update','enctype' => 'multipart/form-data']) !!}
                        @include('settings.front_cms.fields')
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
