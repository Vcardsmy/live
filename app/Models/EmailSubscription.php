<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EmailSubscription
 *
 * @property int $id
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSubscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSubscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSubscription query()
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSubscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSubscription whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSubscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSubscription whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class EmailSubscription extends Model
{
    use HasFactory;

    public $fillable = [
        'email',
    ];

    public static $rules = [
        'email' => 'email:filter|unique:email_subscriptions,email',
    ];
}
