@extends('layouts.app')
@section('title')
    {{__('messages.about_us.about_us')}}
@endsection
@section('content')
    <div class="post flex-column-fluid" id="kt_post">
        <div class="d-flex flex-column flex-lg-row">
            <div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
                @include('flash::message')
                @include('layouts.errors')
                <div class="row">
                    <div class="col-12">
                        {!! Form::open(['route' => 'aboutUs.store','enctype' => 'multipart/form-data']) !!}
                        <div class="card mt-lg-0 mt-10">
                            <div class="row">
                                @foreach($aboutUs as $about)
                                    <div class="col-md-4 col-12">
                                        <div class="card-body pt-md-12 pb-3 pt-8 px-6">
                                            @include('sadmin.aboutUs.about1')
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="d-flex px-6 pb-8">
                                {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-3']) }}
                                <a href="" type="reset"
                                   class="btn btn-light btn-active-light-primary">{{__('messages.common.discard')}}</a>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
