<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Plan
 *
 * @property int $id
 * @property string $name
 * @property int|null $no_of_vcards
 * @property int|null $currency_id
 * @property float|null $price
 * @property int $frequency 1 = Month, 2 = Year
 * @property int $is_default
 * @property int $trial_days Default validity will be 7 trial days
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Currency|null $currency
 * @property-read \App\Models\PlanFeature|null $planFeature
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subscription[] $subscriptions
 * @property-read int|null $subscriptions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Template[] $templates
 * @property-read int|null $templates_count
 * @method static \Illuminate\Database\Eloquent\Builder|Plan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Plan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Plan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereFrequency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereNoOfVcards($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereTrialDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Plan extends Model
{
    use HasFactory;

    protected $table = 'plans';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'currency_id',
        'price',
        'frequency',
        'is_default',
        'trial_days',
        'no_of_vcards',
    ];

    const TRIAL_DAYS = 7;

    const MONTHLY = 1;
    const YEARLY = 2;

    const DURATION = [
        self::MONTHLY => 'Month',
        self::YEARLY  => 'Year',
    ];

    const STRIPE = 1;
    const PAYPAL = 2;
    const RAZORPAY = 3;
    const MANUALLY = 4;

    const PAYMENT_METHOD = [
        self::STRIPE   => 'Stripe',
        self::PAYPAL   => 'Paypal',
        self::RAZORPAY => 'Razorpay',
        self::MANUALLY => 'Manually',
    ];

    /**
     * @var array
     */
    public static $rules = [
        'name'         => 'required|string|min:2|unique:plans,name,',
        'currency_id'  => 'required',
        'no_of_vcards' => 'required|numeric',
    ];

    /**
     *
     * @return BelongsTo
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    /**
     *
     * @return HasOne
     */
    public function planFeature(): HasOne
    {
        return $this->hasOne(PlanFeature::class, 'plan_id');
    }

    /**
     *
     * @return HasMany
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::Class, 'plan_id');
    }

    /**
     *
     * @return BelongsToMany
     */
    public function templates(): BelongsToMany
    {
        return $this->belongsToMany(Template::class);
    }

    /**
     * @return HasMany
     */
    public function hasZeroPlan()
    {
        return $this->hasMany(Subscription::class)->where('plan_amount', 0)->where('tenant_id', getLogInUser()->tenant_id);
    }
}
