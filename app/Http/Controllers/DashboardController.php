<?php

namespace App\Http\Controllers;

use App\Models\ScheduleAppointment;
use App\Models\Vcard;
use App\Repositories\DashboardRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends AppBaseController
{
    /* @var DashboardRepository */
    private $dashboardRepository;

    /**
     * DashboardController constructor.
     * @param  DashboardRepository  $dashboardRepo
     */
    public function __construct(DashboardRepository $dashboardRepo)
    {
        $this->dashboardRepository = $dashboardRepo;
    }

    /**
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $users = $this->dashboardRepository->getUsers();
        $vcards = $this->dashboardRepository->getVcards();
        $plans = $this->dashboardRepository->getPlans();
        $vcardCount = $this->dashboardRepository->getVcardsCount();
        $enquiry = $this->dashboardRepository->getEnquiryCountAttribute();
        $appointment = $this->dashboardRepository->getAppointmentCountAttribute();

        if (\Request::is('sadmin/dashboard')) {
            return view('dashboard.index', compact('users', 'vcards', 'plans'));
        }

        return view('dashboard.index', compact('vcardCount', 'enquiry','appointment'));
    }

    /**
     * @param  Request  $request
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUsersList(Request $request)
    {
        $input = $request->all();

        $data['users'] = $this->dashboardRepository->usersData($input);

        return $this->sendResponse($data, 'Users retrieved successfully.');
    }

    /**
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function appointments(){

        $vcardIds = Vcard::whereTenantId(getLogInTenantId())->pluck('id')->toArray();

        $today = Carbon::now()->format('Y-m-d');

        $appointments = ScheduleAppointment::with('vcard')->whereIn('vcard_id', $vcardIds)->where('date',
            $today)->orderBy('created_at', 'DESC')
            ->paginate(5);

        return $this->sendResponse($appointments, 'Appointment retrieved successfully.');
    }
}
