<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleAppointment extends Model
{
    use HasFactory;

    protected $table = 'schedule_appointments';

    protected $fillable = [
        'name',
        'email',
        'date',
        'phone',
        'from_time',
        'to_time',
        'vcard_id',
    ];

    public static $rules = [
        'name'    => 'required|min:2',
        'email'   => 'required|email:filter',
        'phone'   => 'nullable|numeric|min:0',
    ];

    /**
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vcard()
    {
        return $this->belongsTo(Vcard::class);
    }
}
