<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BusinessHour
 *
 * @property int $id
 * @property int $vcard_id
 * @property int $day_of_week
 * @property string $start_time
 * @property string $end_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessHour newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessHour newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessHour query()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessHour whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessHour whereDayOfWeek($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessHour whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessHour whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessHour whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessHour whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessHour whereVcardId($value)
 * @mixin \Eloquent
 */
class BusinessHour extends Model
{
    use HasFactory;

    protected $table = 'business_hours';

    /**
     * @var array
     */
    protected $fillable = [
        'vcard_id',
        'day_of_week',
        'start_time',
        'end_time',
    ];


    const MON = 1;
    const TUE = 2;
    const WED = 3;
    const THU = 4;
    const FRI = 5;
    const SAT = 6;
    const SUN = 7;


    const DAY_OF_WEEK = [
        self::MON => 'mon',
        self::TUE => 'tue',
        self::WED => 'wed',
        self::THU => 'thu',
        self::FRI => 'fri',
        self::SAT => 'sat',
        self::SUN => 'sun',
    ];

    const WEEKDAY_NAME = [
        self::MON => 'MON',
        self::TUE => 'TUE',
        self::WED => 'WED',
        self::THU => 'THU',
        self::FRI => 'FRI',
        self::SAT => 'SAT',
        self::SUN => 'SUN',
    ];
}
