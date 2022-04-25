@php
    /** @var \App\Models\WeekDay $weekDaySlot */
@endphp
{{--@dd( $time[$day]['start'])--}}
@if(!empty($time[$day]))
    @foreach($time[$day] as $times)
<div class="align-items-center justify-content-between mt-md-0 mt-10 timeSlot">
    <div class="d-flex align-items-center mb-3 add-slot">

                <div class="d-inline-block">
                    {{ Form::select('startTimes['.$day.'][]', getSchedulesTimingSlot(),  $times['start_time'],['class' => 'form-control form-control-solid form-select', 'data-control'=>'select2']) }}
                </div>
                <span class="small-border">-</span>
                <div class="d-inline-block">
                    {{ Form::select('endTimes['.$day.'][]', getSchedulesTimingSlot(), $times['end_time'],['class' => 'form-control form-control-solid form-select ', 'data-control'=>'select2','disabled'=>false]) }}
                </div>
                <a href="javascript:void(0)" class="deleteBtn">
                    <i class="fas fa-trash ms-3 text-danger"></i>
                </a>
    </div>
    <span class="error-msg text-danger"></span>
</div>
    @endforeach
@else
    <div class="align-items-center justify-content-between mt-md-0 mt-10 timeSlot">
        <div class="d-flex align-items-center mb-3 add-slot">

            <div class="d-inline-block">
                {{ Form::select('startTimes['.$day.'][]', getSchedulesTimingSlot(),  null,['class' => 'form-control form-control-solid form-select', 'data-control'=>'select2']) }}
            </div>
            <span class="small-border">-</span>
            <div class="d-inline-block">
                {{ Form::select('endTimes['.$day.'][]', getSchedulesTimingSlot(), null,['class' => 'form-control form-control-solid form-select ', 'data-control'=>'select2','disabled'=>false]) }}
            </div>
            <a href="javascript:void(0)" class="deleteBtn">
                <i class="fas fa-trash ms-3 text-danger"></i>
            </a>
        </div>
        <span class="error-msg text-danger"></span>
    </div>
@endif
