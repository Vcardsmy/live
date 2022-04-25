<?php

use App\Models\Country;
use App\Models\Currency;
use App\Models\PaymentGateway;
use App\Models\Plan;
use App\Models\Role as CustomRole;
use App\Models\Setting;
use App\Models\State;
use App\Models\Subscription;
use App\Models\Template;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Stripe\Stripe;

/**
 *
 * @return Authenticatable|null
 */
function getLogInUser()
{
    return Auth::user();
}
/**
 *
 * @return string[]
 */
function getLanguages()
{
    return User::LANGUAGES;
}
/**
 * @return mixed
 */
function getAppName()
{
    $record = Setting::where('key', '=', 'app_name')->first();
    $appName = (!empty($record)) ? $record->value : config('app.name');

    return $appName;
}

/**
 * @return mixed
 */
function getLogoUrl()
{
    static $appLogo;

    if (empty($appLogo)) {
        $appLogo = Setting::where('key', '=', 'app_logo')->first();
    }

    return $appLogo->logo_url;
}

/**
 * @return mixed
 */
function getFaviconUrl()
{
    static $favicon;

    if (empty($favicon)) {
        $favicon = Setting::with('media')->where('key', '=', 'favicon')->first();
    }

    return $favicon->favicon_url;
}

/**
 * @param array $input
 * @param string $key
 *
 * @return string|null
 */
function preparePhoneNumber($input, $key)
{
    return (!empty($input[$key])) ? '+'.$input['prefix_code'].$input[$key] : null;
}

/**
 * @return mixed
 */
function getSuperAdminRoleId()
{
    return Role::whereName(CustomRole::ROLE_SUPER_ADMIN)->first()->id;
}

/**
 *
 * @return int
 */
function getLogInUserId()
{
    return Auth::user()->id;
}

/**
 *
 * @return mixed
 */
function getLogInTenantId()
{
    return Auth::user()->tenant_id;
}

/**
 * @return mixed
 */
function getLoggedInUserRoleId()
{
    return (Auth::check()) ? Auth::user()->roles()->first()->id : false;
}

/**
 * @return string
 */
function getDashboardURL()
{
    if (Auth::user()->hasRole(CustomRole::ROLE_SUPER_ADMIN)) {
        return RouteServiceProvider::DASHBOARD;
    } elseif (Auth::user()->hasRole(CustomRole::ROLE_ADMIN)) {
        return RouteServiceProvider::ADMIN_DASHBOARD;
    }

    return RouteServiceProvider::HOME;
}

/**
 *
 * @return array
 */
function getCurrencies()
{
    $currencies = Currency::all();
    foreach ($currencies as $currency) {
        $currencyList[$currency->id] = $currency->currency_icon.' - '.$currency->currency_name;
    }

    return $currencyList;
}

/**
 *
 * @return mixed
 */
function getCountry()
{
    $country = Country::orderBy('name')->pluck('name', 'id')->toArray();

    return $country;
}

/**
 *
 * @return mixed
 */
function getState()
{
    $state = State::orderBy('name')->pluck('name', 'id')->toArray();

    return $state;
}

/**
 *
 *
 * @return string[]
 */
function getPayPalSupportedCurrencies()
{
    return [
        'AUD', 'BRL', 'CAD', 'CNY', 'CZK', 'DKK', 'EUR', 'HKD', 'HUF', 'ILS', 'JPY', 'MYR', 'MXN', 'TWD', 'NZD', 'NOK',
        'PHP', 'PLN', 'GBP', 'RUB', 'SGD', 'SEK', 'CHF', 'THB', 'USD',
    ];
}

/**
 * @param null $templates
 *
 * @return array
 */
function getTemplateUrls($templates = null): array
{
    if (!$templates) {
        $templates = Template::all();
    }

    $templateUrls = array();
    foreach ($templates as $template) {
        $templateUrls[$template->id] =asset($template->path);
    }

    return $templateUrls;
}

/**
 * @param $plan
 *
 * @return array
 */
function getPlanFeature($plan): array
{
    $features = $plan->planFeature->getFillable();
    $planFeatures = array();
    foreach ($features as $feature) {
        $planFeatures[$feature] = $plan->planFeature->$feature;
    }
    arsort($planFeatures);

    return Arr::except($planFeatures, 'plan_id');
}

/**
 * @param $vcard
 *
 * @return array
 */
function getSocialLink($vcard): array
{
    $socialLink = array_values(array_diff($vcard->socialLink->getFillable(), ['vcard_id']));
    $vcardSocials = array();
    foreach ($socialLink as $social) {
        if ($vcard->socialLink->$social) {
            if ($social != 'website') {
                if ($url = parse_url($vcard->socialLink->$social, PHP_URL_SCHEME) === null ?
                    'https://'.$vcard->socialLink->$social : $vcard->socialLink->$social) {
                    $vcardSocials[$social] =
                        '<a href="'.$url.'" target="_blank">
                        <i class="fab fa-'.$social.' '.$social.'-icon icon fa-2x" title="'.__('messages.social.'.ucfirst($social)).'"></i>
                    </a>';
                }
            } else {
                if ($url = parse_url($vcard->socialLink->$social, PHP_URL_SCHEME) === null ?
                    'https://'.$vcard->socialLink->$social : $vcard->socialLink->$social) {
                    $vcardSocials[$social] =
                        '<a href="'.$url.'" target="_blank">
                        <i class="fa fa-globe-africa globe-africa-icon icon fa-2x" title="'.__('messages.social.website').'"></i>
                    </a>';
                }
            }
        }

        if ($vcard->location_url != null){
            $vcardSocials['map'] =
                '<a href="'.$vcard->location_url.'" target="_blank">
                        <i class="fas fa-map-marked-alt icon fa-2x" title="'.__('messages.social.map').'"></i>
                    </a>';
        }
    }

    return $vcardSocials;
}

/**
 *
 * @return string[]
 */
function zeroDecimalCurrencies(): array
{
    return [
        'BIF', 'CLP', 'DJF', 'GNF', 'JPY', 'KMF', 'KRW', 'MGA', 'PYG', 'RWF', 'UGX', 'VND', 'VUV', 'XAF', 'XOF', 'XPF',
    ];
}

function getAppLogo()
{
    static $appLogo;

    if (empty($appLogo)) {
        $appLogo = Setting::where('key', '=', 'app_logo')->first()->value;
    }

    return $appLogo;
}

/**
 * @param $number
 *
 * @return mixed|string|string[]
 */
function removeCommaFromNumbers($number)
{
    return (gettype($number) == 'string' && !empty($number)) ? str_replace(',', '', $number) : $number;
}

function setStripeApiKey()
{
    Stripe::setApiKey(config('services.stripe.secret_key'));
}

/**
 * @param $index
 *
 * @return string
 */
function getRandomColor($index): string
{
    $badgeColors = [
        'badge-primary',
        'badge-success',
        'badge-info',
        'badge-secondary',
        'badge-dark',
        'badge-danger',
        'badge-warning',
    ];
    $number = ceil($index % 7);
    return $badgeColors[$number];
}

/**
 *
 * @return mixed
 */
function getCurrentSubscription()
{
    return Subscription::with(['plan'])
        ->whereTenantId(getLogInTenantId())
        ->where('status',Subscription::ACTIVE)->latest()->first();
}

function getCurrentPlanDetails()
{
    $currentSubscription = getCurrentSubscription();
    $isExpired = $currentSubscription->isExpired();
    $currentPlan = $currentSubscription->plan;

    if ($currentPlan->price != $currentSubscription->plan_amount) {
        $currentPlan->price = $currentSubscription->plan_amount;
    }

    $startsAt = Carbon::now();
    $totalDays = Carbon::parse($currentSubscription->starts_at)->diffInDays($currentSubscription->ends_at);
    $usedDays = Carbon::parse($currentSubscription->starts_at)->diffInDays($startsAt);
    if ($totalDays > $usedDays){
        $usedDays = Carbon::parse($currentSubscription->starts_at)->diffInDays($startsAt);
    }
    else
    {
        $usedDays = $totalDays;
    }
    if($totalDays > $usedDays)
    {
        $remainingDays = $totalDays - $usedDays;
    }
    else
    {
        $remainingDays = 0;
    }


    $frequency = $currentSubscription->plan_frequency == Plan::MONTHLY ? 'Monthly' : 'Yearly';

    $days = $currentSubscription->plan_frequency == Plan::MONTHLY ? 30 : 365;

    $perDayPrice = round($currentPlan->price / $days, 2);
    if(!empty($currentSubscription->trial_ends_at || $isExpired)){
        $remainingBalance = 0.00;
        $usedBalance = 0.00;
    } else {
        $remainingBalance = $currentPlan->price - ($perDayPrice * $usedDays);
        $usedBalance = $currentPlan->price - $remainingBalance;
    }

    return [
        'name'             => $currentPlan->name.' / '.$frequency,
        'trialDays'        => $currentPlan->trial_days,
        'startAt'          => Carbon::parse($currentSubscription->starts_at)->format('jS M, Y'),
        'endsAt'           => Carbon::parse($currentSubscription->ends_at)->format('jS M, Y'),
        'usedDays'         => $usedDays,
        'remainingDays'    => $remainingDays,
        'totalDays'        => $totalDays,
        'usedBalance'      => $usedBalance,
        'remainingBalance' => $remainingBalance,
        'isExpired'        => $isExpired,
        'currentPlan'      => $currentPlan,
    ];
}

function checkIfPlanIsInTrial($currentSubscription)
{
    $now = Carbon::now();
    if (!empty($currentSubscription->trial_ends_at) && $currentSubscription->trial_ends_at > $now) {
        return true;
    }

    return false;

}

/**
 * @param $planIDChosenByUser
 *
 * @return array
 */
function getProratedPlanData($planIDChosenByUser)
{
    /** @var Plan $subscriptionPlan */
    $subscriptionPlan = Plan::findOrFail($planIDChosenByUser);
    $newPlanDays = $subscriptionPlan->frequency == Plan::MONTHLY ? 30 : 365;

    $currentSubscription = getCurrentSubscription();
    $frequency = $subscriptionPlan->frequency == Plan::MONTHLY ? 'Monthly' : 'Yearly';

    $startsAt = Carbon::now();

    $carbonParseStartAt = Carbon::parse($currentSubscription->starts_at);
    $usedDays = $carbonParseStartAt->copy()->diffInDays($startsAt);
    $totalExtraDays = 0;
    $totalDays = $newPlanDays;

    $endsAt = Carbon::now()->addDays($newPlanDays);

    $startsAt = $startsAt->copy()->format('jS M, Y');
    if ($usedDays <= 0) {
        $startsAt = $carbonParseStartAt->copy()->format('jS M, Y');
    }

    if (!$currentSubscription->isExpired() && !checkIfPlanIsInTrial($currentSubscription)) {
        $amountToPay = 0;

        $currentPlan = $currentSubscription->plan; // TODO: take fields from subscription

        // checking if the current active subscription plan has the same price and frequency in order to process the calculation for the proration
        $planPrice = $currentPlan->price;
        $planFrequency = $currentPlan->frequency;
        if ($planPrice != $currentSubscription->plan_amount || $planFrequency != $currentSubscription->plan_frequency) {
            $planPrice = $currentSubscription->plan_amount;
            $planFrequency = $currentSubscription->plan_frequency;
        }

        $frequencyDays = $planFrequency == Plan::MONTHLY ? 30 : 365;
        $perDayPrice = round($planPrice / $frequencyDays, 2);

        $remainingBalance = round($planPrice - ($perDayPrice * $usedDays), 2);

        if ($remainingBalance < $subscriptionPlan->price) { // adjust the amount in plan
            $amountToPay = round($subscriptionPlan->price - $remainingBalance, 2);
        } else {
            $perDayPriceOfNewPlan = round($subscriptionPlan->price / $newPlanDays, 2);
            $totalExtraDays = round($remainingBalance / $perDayPriceOfNewPlan);

            $endsAt = Carbon::now()->addDays($totalExtraDays);
            $totalDays = $totalExtraDays;
        }

        return [
            'startDate'        => $startsAt,
            'name'             => $subscriptionPlan->name.' / '.$frequency,
            'trialDays'        => $subscriptionPlan->trial_days,
            'remainingBalance' => $remainingBalance,
            'endDate'          => $endsAt->format('jS M, Y'),
            'amountToPay'      => $amountToPay,
            'usedDays'         => $usedDays,
            'totalExtraDays'   => $totalExtraDays,
            'totalDays'        => $totalDays,
        ];
    }

    return [
        'name'             => $subscriptionPlan->name.' / '.$frequency,
        'trialDays'        => $subscriptionPlan->trial_days,
        'startDate'        => $startsAt,
        'endDate'          => $endsAt->format('jS M, Y'),
        'remainingBalance' => 0,
        'amountToPay'      => $subscriptionPlan->price,
        'usedDays'         => $usedDays,
        'totalExtraDays'   => $totalExtraDays,
        'totalDays'        => $totalDays,
    ];
}

function YoutubeID($url)
{
    if(strlen($url) > 11)
    {
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match))
        {
            return $match[1];
        }
        else
            return false;
    }

    return $url;
}

/**
 * @return array
 */
function isSubscriptionExpired(): array
{
    $subscription = Subscription::with('plan')
        ->where('status', Subscription::ACTIVE)
        ->where('tenant_id',getLogInTenantId())
        ->first();

    if ($subscription == null) {
        return [
            'status'  => true,
            'message' => 'Please choose a plan to continue the service.',
        ];
    }

    /** @var Subscription $subscription */
    $subscriptionEndDate = Carbon::parse($subscription->trial_ends_at);

    if ($subscription->trial_ends_at == null) {
        $subscriptionEndDate = Carbon::parse($subscription->ends_at);
    }
    $startsAt = Carbon::now();
    $totalDays = Carbon::parse($subscription->starts_at)->diffInDays($subscriptionEndDate);
    $usedDays = Carbon::parse($subscription->starts_at)->diffInDays($startsAt);
    $diffInDays = $totalDays - $usedDays;

    if ($subscription->ends_at > Carbon::now()) {
        return [
            'status'  => false,
        ];
    }
    
    $expirationMessage = null;
    if ($diffInDays <= getSuperAdminSettingValue('plan_expire_notification') && $diffInDays > 0 ) {
        $expirationMessage = __('messages.your')." '{$subscription->plan->name}' ".__('messages.expire_in')." {$diffInDays} ".__('messages.plan.days');
    } else {
        $expirationMessage = __('messages.your')." '{$subscription->plan->name}' ".__('messages.plan_expire');
    }

    return [
        'status'  => $diffInDays <= getSuperAdminSettingValue('plan_expire_notification'),
        'message' => $expirationMessage,
    ];
}

/**
 * @param $plan
 *
 * @return Carbon|null
 */
function setExpiryDate($plan): ?Carbon
{
    $expiryDate = '';
    if ($plan->frequency == Plan::MONTHLY) {
        $date = Carbon::now()->addMonths($plan->valid_upto);
    } elseif ($plan->frequency == Plan::YEARLY) {
        $date = Carbon::now()->addYears($plan->valid_upto);
    } else {
        $expiryDate = null;
    }

    $currentSubs = getCurrentSubscription();
    $remainingDays = '';
    if ($currentSubs->ends_at > Carbon::now()) {
        $remainingDays = Carbon::parse($currentSubs->ends_at)->diffInDays();
    }
    if (isset($date)) {
        $expiryDate = $date->addDays($remainingDays);
    }

    return $expiryDate;
}

/**
 * @param $partName
 *
 * @return bool
 */
function checkFeature($partName)
{
    $currentPlan = getCurrentSubscription()->plan;

    if ($partName == 'services' && !$currentPlan->planFeature->products_services) {
        return false;
    }
    if ($partName == 'products' && !$currentPlan->planFeature->products) {
        return false;
    }
    if ($partName == 'appointments' && !$currentPlan->planFeature->appointments) {
        return false;
    }
    if ($partName == 'testimonials' && !$currentPlan->planFeature->testimonials) {
        return false;
    }
    if ($partName == 'social_links' && !$currentPlan->planFeature->social_links) {
        return false;
    }
    if ($partName == 'custom_fonts' && !$currentPlan->planFeature->custom_fonts) {
        return false;
    }
    if ($partName == 'gallery' && !$currentPlan->planFeature->gallery) {
        return false;
    }
    if ($partName == 'seo' && !$currentPlan->planFeature->seo) {
        return false;
    }
    if ($partName == 'advanced') {
        $feature = $currentPlan->planFeature;
        if (!$feature->password && !$feature->hide_branding && !$feature->custom_css && !$feature->custom_js) {
            return false;
        }

        return $feature;
    }

    return true;
}

/**
 *
 *
 * @return bool
 */
function analyticsFeature(): bool
{
    $currentPlan = getCurrentSubscription()->plan;

    if ($currentPlan->planFeature->analytics) {
        return true;
    }

    return false;
}

/**
 * @return int
 */
function planfeaturecount()
{
    $cntcount = 0;
    $planstatus = \App\Models\PlanFeature::wherePlanId(getCurrentSubscription()->plan->id)->first();

    foreach (getPlanFeature(getCurrentSubscription()->plan) as $feature => $value) {

        if($value) {

            $cntcount++;
        }
    }

    if($planstatus->enquiry_form == 1)
    {
        $cntcount--;
    }
    if($planstatus->hide_branding == 1)
    {
        $cntcount--;
    }
    if($planstatus->password == 1)
    {
        $cntcount--;
    }
    if($planstatus->custom_js == 1)
    {
        $cntcount--;
    }
    if($planstatus->custom_css ==1)
    {
        $cntcount--;
    }

    return $cntcount;
}

/**
 *
 *
 * @return array
 */
function getSchedulesTimingSlot()
{
    $period = new CarbonPeriod('00:00', "15 minutes", '24:00'); // for create use 24 hours format later change format
    $slots = [];
    foreach ($period as $item) {
        $slots[$item->format("h:i A")] = $item->format("h:i A");
    }

    return $slots;
}

/**
 *
 * @return array
 */
function getBusinessHours(): array
{
    $period = new CarbonPeriod('00:00', "15 minutes", '24:00'); // for create use 24 hours format later change format
    $times = [];
    foreach ($period as $item) {
        $times[$item->format("H:i")] = $item->format("H:i");
    }

    return $times;
}

/**
 * @param $key
 *
 * @return mixed
 */
function getSuperAdminSettingValue($key)
{
    return Setting::where('key', $key)->value('value');
}

/**
 * @param $part
 *
 *
 * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null
 */
function getSuccessMessage($part)
{
    if ($part == null) {
        return __('messages.vcard.basic_details');
    } else {
        if ($part == 'basic') {
            return __('messages.vcard.basic_details');
        } else {
            return __('messages.vcard.'.$part);
        }
    }
}

/**
 *
 *
 * @return \Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed|string|null
 */
function getCurrentLanguageName()
{
    return User::whereId(Auth::id())->first()->language;
}

/**
 *
 *
 * @return string
 */
function getSelectedLanguageName()
{
    return User::LANGUAGES[checkLanguageSession()];
}

/**
 *
 *
 * @return mixed|string
 */
function checkLanguageSession()
{
    if (Session::has('languageChange')) {
        return Session::get('languageChange');
    }

    return 'en';
}

/**
 *
 *
 * @return mixed|string
 */
function checkFrontLanguageSession()
{
    if (Session::has('languageName')) {
        return Session::get('languageName');
    }

    return 'en';
}

/**
 * @param $countryName
 *
 *
 * @return string
 */
function get_country_flag($countryName): string
{
    $code = '';
    $countriesArr = json_decode(file_get_contents(storage_path('countries/countries.json')));
    foreach ($countriesArr->countries as $country) {
        if ($country->name == $countryName) {
            $code = country_flag($country->short_code);
        }
    }

    return $code;
}

/**
 *
 *
 * @return string[]
 */
function getPaymentGateway()
{
    $paymentGateway = \App\Models\Subscription::PAYMENT_GATEWAY;
    $selectedPaymentGateway = $selectedPaymentGateways = PaymentGateway::pluck('payment_gateway')->toArray();

    return array_intersect($paymentGateway, $selectedPaymentGateway);
}

/**
 * @return string
 */
function getRandColor(): string
{
    $bgColors = [
        'success',
        'primary',
        'info',
        'success',
        'dark',
        'secondary',
        'danger',
        'warning',
    ];

    $number = ceil(rand() % 7);
    return $bgColors[$number];
}
