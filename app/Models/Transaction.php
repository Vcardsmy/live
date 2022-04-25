<?php

namespace App\Models;

use App\Traits\Multitenantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\Transaction
 *
 * @property int $id
 * @property string $transaction_id
 * @property float $amount
 * @property int $type
 * @property string $tenant_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTenantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\MultiTenant $tenant
 * @property int|null $status
 * @property string|null $meta
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereStatus($value)
 */
class Transaction extends Model
{
    use HasFactory, BelongsToTenant, Multitenantable;

    protected $table = 'transactions';

    /**
     * @var string[]
     */
    protected $fillable = [
        'transaction_id',
        'amount',
        'type',
        'tenant_id',
        'status',
        'meta'
    ];

    const SUCCESS = 1;
    const FAILED = 0;
    
    const STRIPE = 1;
    
    const TYPE = [
        self::STRIPE => 'Stripe',
    ];
}
