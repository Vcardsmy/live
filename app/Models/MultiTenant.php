<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Events\CreatingTenant;
use Stancl\Tenancy\Events\DeletingTenant;
use Stancl\Tenancy\Events\SavingTenant;
use Stancl\Tenancy\Events\TenantDeleted;
use Stancl\Tenancy\Events\TenantSaved;
use Stancl\Tenancy\Events\TenantUpdated;
use Stancl\Tenancy\Events\UpdatingTenant;

/**
 * Class CustomTenant
 *
 * @property string $id
 * @property string $tenant_username
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property array|null $data
 * @property-read \App\Models\User $user
 * @method static \Stancl\Tenancy\Database\TenantCollection|static[] all($columns = ['*'])
 * @method static \Stancl\Tenancy\Database\TenantCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|MultiTenant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MultiTenant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MultiTenant query()
 * @method static \Illuminate\Database\Eloquent\Builder|MultiTenant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MultiTenant whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MultiTenant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MultiTenant whereTenantUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MultiTenant whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MultiTenant extends BaseTenant
{
    public static function getCustomColumns(): array
    {
        return [
            'id',
            'tenant_username',
        ];
    }

    protected $casts = [
        'data' => 'array',
    ];

    protected $dispatchesEvents = [
        'saving'   => SavingTenant::class,
        'saved'    => TenantSaved::class,
        'creating' => CreatingTenant::class,
        //        'created' => TenantCreated::class,
        'updating' => UpdatingTenant::class,
        'updated'  => TenantUpdated::class,
        'deleting' => DeletingTenant::class,
        'deleted'  => TenantDeleted::class,
    ];


    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'tenant_id');
    }
}
