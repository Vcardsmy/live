<?php

namespace App\Repositories;

use App\Models\Enquiry;
use App\Models\Plan;
use App\Models\ScheduleAppointment;
use App\Models\User;
use App\Models\Vcard;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class CityRepository
 * @package App\Repositories
 * @version July 31, 2021, 7:41 am UTC
 */
class DashboardRepository
{
    /**
     *
     *
     * @return \App\Models\Builder|User|User[]|\Illuminate\Database\Eloquent\Builder|Collection
     */
    public function getUsers()
    {
        return User::whereHas("roles", function ($q) {
            $q->where("name", "!=", "super_admin");
        })->get();
    }

    /**
     *
     *
     * @return Vcard[]|Collection
     */
    public function getVcards()
    {
        return Vcard::all();
    }

    /**
     *
     *
     * @return Plan[]|Collection
     */
    public function getPlans()
    {
        return Plan::all();
    }

    /**
     *
     *
     * @return mixed
     */
    public function getVcardsCount()
    {
        return Vcard::where('tenant_id', auth()->user()->tenant_id)->get();
    }

    /**
     *
     *
     * @return mixed
     */
    public function getEnquiryCountAttribute()
    {

        $vcardIds = Vcard::where('tenant_id', auth()->user()->tenant_id)->select('id');

        return Enquiry::whereIn('vcard_id', $vcardIds)->whereDate('created_at', \Carbon\Carbon::today())->count();
    }

    /**
     *
     *
     * @return mixed
     */
    public function getAppointmentCountAttribute()
    {

        $vcardIds = Vcard::where('tenant_id', auth()->user()->tenant_id)->select('id');

        $today = Carbon::now()->format('Y-m-d');

        return ScheduleAppointment::whereIn('vcard_id', $vcardIds)->where('date', $today)->count();
    }

    /**
     * @param $input
     *
     *
     */
    public function usersData($input)
    {
        if (isset($input['day'])) {
            $data = User::whereRaw('Date(created_at) = CURDATE()')->orderBy('created_at', 'DESC')
                ->paginate(5);;
            return $data;
        }

        if (isset($input['week'])) {
            $now = Carbon::now();
            $weekStartDate = $now->startOfWeek()->format('Y-m-d H:i');
            $weekEndDate = $now->endOfWeek()->format('Y-m-d H:i');
            $data = User::whereBetween('created_at', [$weekStartDate, $weekEndDate])
                ->orderBy('created_at', 'DESC')
                ->paginate(5);

            return $data;
        }

        if (isset($input['month'])) {
            $data = User::whereMonth('created_at', Carbon::now()->month)
                ->orderBy('created_at', 'DESC')
                ->paginate(5);

            return $data;
        }
    }
}
