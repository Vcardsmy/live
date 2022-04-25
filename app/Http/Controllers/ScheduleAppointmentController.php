<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateScheduleAppointmentRequest;
use App\Models\ScheduleAppointment;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ScheduleAppointmentController extends AppBaseController
{
    public function store(CreateScheduleAppointmentRequest $request){

        $input = $request->all();

        ScheduleAppointment::create($input);

        return $this->sendSuccess('Appointment created successfully.');

    }

    /**
     * @param  Request  $request
     *
     * @throws \Exception
     *
     *@return Application|Factory|View
     */
    public function appointmentsList(){
        
        return view('appointment.list');
    }
}
