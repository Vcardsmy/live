<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SocialAccount extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'social_accounts';
    /**
     * @var string[]
     */
    protected $fillable = [
        'tenant_id',
        'provider',
        'provider_id',
    ];

    /**
     *
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
