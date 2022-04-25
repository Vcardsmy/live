<?php

namespace App\Models;

use App\Traits\Multitenantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\Subscription
 *
 * @property int $id
 * @property string $tenant_id
 * @property int|null $plan_id
 * @property int|null $transaction_id
 * @property float|null $plan_amount
 * @property int $plan_frequency 1 = Month, 2 = Year
 * @property string $starts_at
 * @property string $ends_at
 * @property string|null $trial_ends_at
 * @property float|null $no_of_vcards
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Models\Plan|null $plan
 * @property-read \App\Models\MultiTenant $tenant
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription query()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereNoOfVcards($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription wherePlanAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription wherePlanFrequency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription wherePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereStartsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereTenantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereTrialEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Transaction|null $transactions
 */
class Subscription extends Model
{
    use HasFactory, BelongsToTenant, Multitenantable;

    protected $table = 'subscriptions';
    protected $with = ['plan'];
    const TRIAL_DAYS = 7;

    const TYPE_FREE = 0;
    const TYPE_STRIPE = 1;
    const TYPE_PAYPAL = 2;
    const TYPE_RAZORPAY = 3;
   
    const STRIPE = 1;
    const PAYPAL = 2;
    const RAZORPAY = 3;
    const MANUALLY = 4;

    const PAYMENT_GATEWAY = [
        self::STRIPE   => 'Stripe',
        self::PAYPAL => 'Paypal',
        self::RAZORPAY => 'Razorpay',
        self::MANUALLY => 'Manually',
    ];

    const PAYMENT_TYPES = [
        self::TYPE_FREE   => 'Free Plan',
        self::TYPE_STRIPE => 'Stripe',
        self::TYPE_PAYPAL => 'PayPal',
        self::TYPE_RAZORPAY => 'RazorPay',
    ];

    const TYPE = [
        'stripe' => 'Stripe',
        'paypal' => 'PayPal',
        'razorpay' => 'RazorPay',
        'manually' => 'Manually',
    ];

    const ACTIVE = 1;
    const INACTIVE = 0;

    const STATUS_ARR = [
        self::ACTIVE   => 'Active',
        self::INACTIVE => 'Deactive',
    ];

    const MONTH = 'Month';
    const YEAR = 'Year';

    /**
     * @var array
     */
    protected $fillable = [
        'tenant_id',
        'plan_id',
        'transaction_id',
        'plan_amount',
        'plan_frequency',
        'starts_at',
        'ends_at',
        'trial_ends_at',
        'status',
        'no_of_vcards',
        'payment_type'
    ];

    /**
     *
     * @return BelongsTo
     */
    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    public function isExpired()
    {
        $now = Carbon::now();

        if ($this->ends_at > $now) {
            return false;
        }

        // this means the subscription is ended.
        if ((! empty($this->trial_ends_at) && $this->trial_ends_at < $now) || $this->ends_at < $now) {
            return true;
        }

        // this means the subscription is not ended.
        return false;
    }

    /**
     *
     * @return HasOne
     */
    public function transactions()
    {
        return $this->hasOne(Transaction::class, 'transaction_id','id');
    }

    /**
     *
     *
     * @return BelongsTo
     */
    public function users()
    {
        return $this->belongsTo(Subscription::class);
    }
}
