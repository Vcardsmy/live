<?php

namespace App\Http\Controllers;

use App\DataTables\VcardDataTable;
use App\Http\Requests\CreateVcardRequest;
use App\Http\Requests\UpdateVcardRequest;
use App\Models\Appointment;
use App\Models\ScheduleAppointment;
use App\Models\Setting;
use App\Models\Vcard;
use App\Repositories\VcardRepository;
use Carbon\Carbon;
use DataTables;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Crypt;
use Laracasts\Flash\Flash;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class VcardController extends AppBaseController
{
    /**
     * @var vcardRepository
     */
    private $vcardRepository;

    /**
     * VcardController constructor.
     * @param  VcardRepository  $vcardRepository
     */
    public function __construct(VcardRepository $vcardRepository)
    {
        $this->vcardRepository = $vcardRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $makeVcard = $this->vcardRepository->checkTotalVcard();

        return view('vcards.index', compact('makeVcard'));
    }

    /**
     * @param  Request  $request
     *
     *
     * @return Application|Factory|View
     */
    public function template(Request $request)
    {

        if ($request->ajax()) {
            return Datatables::of((new VcardDataTable())->getTemplates())->make(true);
        }

        return view('sadmin.vcards.index');
    }

    /**
     * @param $id
     *
     * @return JsonResponse
     */
    public function download($id)
    {
        $data = Vcard::where('id', $id)->first();

        return $this->sendResponse($data, __('messages.flash.vcard_retrieve'));
    }


    /**
     * @param  Request  $request
     *
     *
     * @return Application|Factory|View
     */
    public function vcards(Request $request)
    {

        if ($request->ajax()) {
            return Datatables::of((new VcardDataTable())->get())->make(true);
        }

        $makeVcard = $this->vcardRepository->checkTotalVcard();

        return view('vcards.templates', compact('makeVcard'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $makeVcard = $this->vcardRepository->checkTotalVcard();
        if (!$makeVcard) {
            return redirect(route('vcards.index'));
        }

        $partName = 'basic';

        return view('vcards.create', compact('partName'));
    }


    /**
     * @param  CreateVcardRequest  $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateVcardRequest $request)
    {
        $input = $request->all();

        $vcard = $this->vcardRepository->store($input);

        Flash::success(__('messages.flash.vcard_create'));

        return redirect(route('vcards.edit', $vcard->id));
    }

    /**
     * @param $alias
     *
     * @return Application|Factory|View
     */
    public function show($alias)
    {
        $vcard = Vcard::with([
            'businessHours' => function ($query) {
                $query->where('end_time', '!=', '00:00');
            }, 'services', 'testimonials', 'products',
        ])->whereUrlAlias($alias)->first();

        if (!$vcard->status) {
            return view(abort('404'));
        }
        $setting = Setting::pluck('value', 'key')->toArray();
        $vcard_name = $vcard->template->name;

        return view('vcardTemplates.'.$vcard_name, compact('vcard', 'setting'));
    }

    /**
     * @param  Request  $request
     * @param  Vcard  $vcard
     *
     * @return JsonResponse
     */
    public function checkPassword(Request $request, Vcard $vcard)
    {
        if (Crypt::decrypt($vcard->password) == $request->password) {
            return $this->sendSuccess('Password is correct');
        } else {
            return $this->sendError('Password is Invalid');
        }
    }

    /**
     * @param  Vcard  $vcard
     * @param  Request  $request
     *
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function edit(Vcard $vcard, Request $request)
    {
        $partName = ($request->part === null) ? 'basic' : $request->part;
        if (!checkFeature($partName)) {
            return redirect(route('vcards.edit', $vcard->id));
        }

        $data = $this->vcardRepository->edit($vcard);
        $data['partName'] = $partName;
        return view('vcards.edit')->with($data);
    }

    /**
     * @param  Vcard  $vcard
     *
     *
     * @return JsonResponse
     */
    public function updateStatus(Vcard $vcard): JsonResponse
    {
        $vcard->update([
            'status' => !$vcard->status,
        ]);

        return $this->sendSuccess(__('messages.flash.vcard_status'));
    }

    /**
     * @param  UpdateVcardRequest  $request
     * @param  Vcard  $vcard
     *
     * @return RedirectResponse
     */
    public function update(UpdateVcardRequest $request, Vcard $vcard)
    {
        $input = $request->all();

        $this->vcardRepository->update($input, $vcard);

        \Session::flash('success', ' '.__('messages.flash.vcard_update'));

        return redirect()->back();
    }

    /**
     * @param  Vcard  $vcard
     *
     * @return JsonResponse
     */
    public function destroy(Vcard $vcard): JsonResponse
    {
        $vcard->clearMediaCollection(Vcard::PROFILE_PATH);
        $vcard->clearMediaCollection(Vcard::COVER_PATH);
        $vcard->delete();

        $data['make_vcard'] = $this->vcardRepository->checkTotalVcard();

        return $this->sendResponse($data, __('messages.flash.vcard_delete'));
    }

    /**
     * @param  Request  $request
     *
     *
     * @return JsonResponse
     */
    public function getSlot(Request $request)
    {
        $day = $request->get('day');
        $slots = getSchedulesTimingSlot();
        $html = view('vcards.appointment.slot', ['slots' => $slots, 'day' => $day])->render();

        return $this->sendResponse($html, 'Retrieved successfully.');
    }

    /**
     * @param  Request  $request
     *
     *
     * @return JsonResponse
     */
    public function getSession(Request $request)
    {
        $vcardId = $request->get('vcardId');

        $date = Carbon::createFromFormat('Y-m-d', $request->date);

        $WeekDaySessions = Appointment::where('day_of_week', $date->dayOfWeek)->where('vcard_id', $vcardId)->get();

        if ($WeekDaySessions->count() == 0) {
            return $this->sendError('There is no available slots on given date.');
        }

        $bookedAppointments = ScheduleAppointment::where('vcard_id', $vcardId)->get();

        $bookingSlot = [];
        $bookedSlot = [];

        foreach ($bookedAppointments as $appointment) {

            if ($appointment->date == $request->date) {
                $bookedSlot[] = $appointment->from_time.' - '.$appointment->to_time;
            }
        }

        foreach ($WeekDaySessions as $index => $WeekDaySessions) {

            $bookingSlot[] = $WeekDaySessions->start_time.' - '.$WeekDaySessions->end_time;

        }

        $slots = array_diff($bookingSlot, $bookedSlot);

        if ($slots == null) {
            return $this->sendError('There is no available slots on given date.');
        }

        return $this->sendResponse($slots, 'Retrieved successfully.');
    }

    public function language($languageName){

        session(['languageChange' => $languageName]);

        return $this->sendSuccess('Language Change SuccessFully');
    }

    /**
     * @param  Vcard  $vcard
     * @param  Request  $request
     *
     *
     * @return Application|Factory|View
     */
    public function analytics(Vcard $vcard, Request $request)
    {
        $input = $request->all();
        $data = $this->vcardRepository->analyticsData($input, $vcard);
        $partName = ($request->part === null) ? 'overview' : $request->part;
        return view('vcards.analytic', compact('vcard', 'partName', 'data'));
    }

    /**
     * @param  Request  $request
     *
     *
     * @return JsonResponse
     */
    public function chartData(Request $request)
    {

        try {
            $input = $request->all();
            $data = $this->vcardRepository->chartData($input);

            return $this->sendResponse($data, 'Users fetch successfully.');

        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }


    }

    /**
     * @param  Request  $request
     * @return mixed
     */
    public function dashboardChartData(Request $request)
    {
        try {
            $input = $request->all();
            $data = $this->vcardRepository->dashboardChartData($input);

            return $this->sendResponse($data, 'Data fetch successfully.');

        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

}
