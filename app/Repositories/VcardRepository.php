<?php

namespace App\Repositories;

use App\Models\Analytic;
use App\Models\Appointment;
use App\Models\BusinessHour;
use App\Models\Country;
use App\Models\SocialLink;
use App\Models\Subscription;
use App\Models\Vcard;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Yajra\DataTables\Exceptions\Exception;

class VcardRepository extends BaseRepository
{
    /**
     * @var array
     */
    public $fieldSearchable = [
        'name',
    ];

    /**
     * @inheritDoc
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * @inheritDoc
     */
    public function model()
    {
        return Vcard::class;
    }

    /**
     * @param $input
     *
     * @return mixed
     */
    public function store($input)
    {
        try {
            DB::beginTransaction();
            if (isset($input['url_alias'])) {
                $input['url_alias'] = str_replace(' ', '-', $input['url_alias']);
            }
            $subscription = getCurrentSubscription();
            if ($subscription->plan) {
                $input['template_id'] = $subscription->plan->templates->first()->id;
            }
            $vcard = Vcard::create($input);

            $input['vcard_id'] = $vcard->id;
            SocialLink::create($input);

            if (isset($input['profile_img']) && !empty($input['profile_img'])) {
                $vcard->addMedia($input['profile_img'])->toMediaCollection(Vcard::PROFILE_PATH,
                    config('app.media_disc'));
            }
            if (isset($input['cover_img']) && !empty($input['cover_img'])) {
                $vcard->addMedia($input['cover_img'])->toMediaCollection(Vcard::COVER_PATH, config('app.media_disc'));
            }

            DB::commit();

            return $vcard;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param $vcard
     *
     * @return array
     */
    public function edit($vcard): array
    {
        $data['vcard'] = $vcard;

        $businessHours = $vcard->businessHours()->get();

        foreach ($businessHours as $hour) {
            $data['hours'][$hour->day_of_week] = [
                'start_time' => $hour->start_time,
                'end_time'   => $hour->end_time,
            ];
        }

        $appointmentHours = $vcard->appointmentHours()->get()->groupBy('day_of_week');

        foreach ($appointmentHours as $day => $hours) {
            foreach ($hours as $hour){
                $data['time'][$day][] = [
                    'start_time' => $hour->start_time,
                    'end_time'   => $hour->end_time,
                ];
            }
        }

        $data['socialLink'] = SocialLink::whereVcardId($vcard->id)->first();
        $currentPlan = getCurrentSubscription();
        if ($currentPlan->plan) {
            $data['templates'] = getTemplateUrls($currentPlan->plan->templates);
        } else {
            $data['templates'] = getTemplateUrls();
        }

        return $data;
    }

    /**
     * @param array $input
     * @param int $vcard
     *
     *
     * @return Builder|Builder[]|Collection|Model|int
     */
    public function update($input, $vcard)
    {
        try {
            DB::beginTransaction();
            if (isset($input['url_alias'])) {
                $input['url_alias'] = str_replace(' ', '-', $input['url_alias']);
            }
            if (isset($input['phone'])) {
                $input['phone'] = str_replace([' ','-'], '', $input['phone']);
            }
            if (isset($input['part']) && $input['part'] == 'template') {
                $planTemplates = getCurrentSubscription()->plan->templates()->pluck('template_id')->toArray();
                if(!in_array($input['template_id'], $planTemplates)){
                    $input['template_id'] = $planTemplates[array_rand($planTemplates)];
                }
                $input['share_btn'] = isset($input['share_btn']);
                $input['status'] = isset($input['status']);
            }
            if (isset($input['part']) && $input['part'] == 'advanced') {
                $input['password'] = isset($input['password']) ? Crypt::encrypt($input['password']) : '';
                $input['branding'] = isset($input['branding']);
            }

            $vcard->update($input);

            if (isset($input['part']) && $input['part'] == 'business_hours') {
                BusinessHour::whereVcardId($vcard->id)->delete();
                if(isset($input['days'])){
                    foreach ($input['days'] as $day) {
                        BusinessHour::create([
                            'vcard_id'    => $vcard->id,
                            'day_of_week' => $day,
                            'start_time'  => $input['startTime'][$day],
                            'end_time'    => $input['endTime'][$day],
                        ]);
                    }
                }
            }

            if (isset($input['part']) && $input['part'] == 'appointments') {
                Appointment::whereVcardId($vcard->id)->delete();
                if(isset($input['checked_week_days'])){
                    foreach ($input['checked_week_days'] as $day) {
                        $this->saveSlots($input, $day, $vcard);
                    }
                }
            }

            $socialLink = SocialLink::whereVcardId($vcard->id)->first();
            $socialLink->update($input);

            if (isset($input['profile_img']) && !empty($input['profile_img'])) {
                $vcard->clearMediaCollection(Vcard::PROFILE_PATH);
                $vcard->addMedia($input['profile_img'])->toMediaCollection(Vcard::PROFILE_PATH,
                    config('app.media_disc'));
            }
            if (isset($input['cover_img']) && !empty($input['cover_img'])) {
                $vcard->clearMediaCollection(Vcard::COVER_PATH);
                $vcard->addMedia($input['cover_img'])->toMediaCollection(Vcard::COVER_PATH, config('app.media_disc'));
            }

            DB::commit();

            return $vcard;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     *
     * @return bool
     */
    public function checkTotalVcard(): bool
    {
        $makeVcard = false;
        $subscription = Subscription::where('tenant_id', getLogInTenantId())->where('status',
            Subscription::ACTIVE)->first();

        if (!empty($subscription)){
            $totalCards = Vcard::whereTenantId(getLogInTenantId())->count();
            $makeVcard = $subscription->no_of_vcards > $totalCards;
        }

        return $makeVcard;
    }

    /**
     * @param $input
     * @param $day
     * @param $vcard
     *
     *
     * @return bool
     */
    public function saveSlots($input, $day, $vcard)
    {
        $startTimeArr = $input['startTimes'][$day] ?? [];
        $endTimeArr = $input['endTimes'][$day] ?? [];
        if (count($startTimeArr) != 0 && count($endTimeArr) != 0) {
            foreach (array_unique($startTimeArr) as $key => $startTime) {
                Appointment::create([
                    'vcard_id'    => $vcard->id,
                    'day_of_week' => $day,
                    'start_time'  => $startTime,
                    'end_time'    => $endTimeArr[$key],
                ]);
            }
        }

        return true;
    }

    /**
     * @param $input
     * @param $vcard
     *
     *
     * @return array
     */
    public function analyticsData($input, $vcard): array
    {

        $analytics = Analytic::where('vcard_id', $vcard->id)->get();
        if($analytics->count() > 0){
            $DataCount = $analytics->count();
            $percentage = 100/$DataCount;
            $browser = $analytics->groupBy('browser');
            $data = [];
            foreach ($browser as $key => $item){
                $browser_record[$key]['count'] =  $item->count();
                $browser_record[$key]['per'] =  $item->count()*$percentage;
            }
            
            $browser_data = collect($browser_record)->sortBy('count')->reverse()->toArray();
           
            $data['browser'] = $browser_data;

            $device = $analytics->groupBy('device');

            foreach ($device as $key => $item){
                $device_record[$key]['count'] =  $item->count();
                $device_record[$key]['per'] =  $item->count()*$percentage;
            }

            $device_data = collect($device_record)->sortBy('count')->reverse()->toArray();
           
            $data['device'] = $device_data;

            $country = $analytics->groupBy('country');

            foreach ($country as $key => $item){
                $country_record[$key]['count'] =  $item->count();
                $country_record[$key]['per'] =  $item->count()*$percentage;
            }

            $country_data = collect($country_record)->sortBy('count')->reverse()->toArray();
            
            $data['country'] = $country_data;

            $operating_system = $analytics->groupBy('operating_system');

            foreach ($operating_system as $key => $item){
                $operating_record[$key]['count'] =  $item->count();
                $operating_record[$key]['per'] =  $item->count()*$percentage;
            }

            $operating_data = collect($operating_record)->sortBy('count')->reverse()->toArray();
            
            $data['operating_system'] = $operating_data;

            $language = $analytics->groupBy('language');

            foreach ($language as $key => $item){

                $language_record[$key]['count'] =  $item->count();
                $language_record[$key]['per'] =  $item->count()*$percentage;
            }

            $language_data = collect($language_record)->sortBy('count')->reverse()->toArray();
            
            $data['language'] = $language_data;

            $data['vcardID']  = $vcard->id;

            return $data;
        }
        $data['noRecord'] = 'No Record Found';
        return $data;

    }

    /**
     * @param $input
     *
     *
     * @return array
     */
    public function chartData($input): array
    {
        $startDate = isset($input['start_date']) ? Carbon::parse($input['start_date']) : '';
        $endDate = isset($input['end_date']) ? Carbon::parse($input['end_date']) : '';
        $data = [];

        $analytics = Analytic::where('vcard_id', $input['vcardId']);
        $visitor = $analytics->addSelect([\DB::raw('DAY(created_at) as day,created_at')])
            ->addSelect([\DB::raw('Month(created_at) as month,created_at')])
            ->addSelect([\DB::raw('YEAR(created_at) as year,created_at')])
            ->orderBy('created_at')
            ->get();
        $period = CarbonPeriod::create($startDate, $endDate);

        foreach ($period as $date) {
            $data['totalVisitorCount'][] = $visitor->where('day', $date->format('d'))->where('month',
                $date->format('m'))->count();
            $data['weeklyLabels'][] = $date->format('d-m-y');
        }

        return $data;
    }

    public function dashboardChartData($input)
    {
        $startDate = isset($input['start_date']) ? Carbon::parse($input['start_date']) : '';
        $endDate = isset($input['end_date']) ? Carbon::parse($input['end_date']) : '';
        $data = [];

        $vcardIds = Vcard::where('tenant_id', getLogInTenantId())->pluck('id')->toArray();

        $analytics = Analytic::with('vcard')->whereIn('vcard_id', $vcardIds);
        $visitor = $analytics->addSelect([\DB::raw('DAY(created_at) as day,created_at')])
            ->addSelect([\DB::raw('Month(created_at) as month,created_at')])
            ->addSelect([\DB::raw('YEAR(created_at) as year,created_at')])
            ->addSelect([\DB::raw('vcard_id')])
            ->orderBy('created_at')
            ->get();
        $period = CarbonPeriod::create($startDate, $endDate);

        foreach ($period as $date) {
            $data['totalVisitorCount'][] = $visitor->where('day', $date->format('d'))->where('month',
                $date->format('m'))->count();
            $data['weeklyLabels'][] = $date->format('d-m-y');
        }

        foreach ($vcardIds as $vcardId) {
            $data['data'][] = $this->getData($vcardId, $startDate, $endDate);
        }

        return $data;
    }

    public function getData($vcardId, $startDate, $endDate)
    {
        $colors = [
            '#E8FFF3',
            '#109EF7',
            '#FFF5F8',
            '#1E1E2D',
            '#FEC702',
            '#50CD89',
            '#F1416C',
            '#50CD89',
            '#F5981C',
        ];
        $period = CarbonPeriod::create($startDate, $endDate);
        $data = [];
        $vcard = Vcard::where('id', $vcardId)->first();
        $data['backgroundColor'] = $colors[rand(0, 8)];
        $data['label'] = $vcard->name;
        $data['data'] = $this->getVisitor($period, $vcard->id);
        $data['lineTension'] = 0.5;
        $data['radius'] = 4;

        return $data;
    }


    public function getVisitor($period, $vcardId)
    {
        $analytics = Analytic::where('vcard_id', $vcardId);
        $visitor = $analytics->addSelect([\DB::raw('DAY(created_at) as day,created_at')])
            ->addSelect([\DB::raw('Month(created_at) as month,created_at')])
            ->addSelect([\DB::raw('YEAR(created_at) as year,created_at')])
            ->orderBy('created_at')
            ->get();
        $data = [];
        foreach ($period as $date) {
            $data[] = $visitor->where('day', $date->format('d'))->where('month',
                $date->format('m'))->count();
        }

        return $data;
    }
}
