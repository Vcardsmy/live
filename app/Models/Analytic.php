<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Analytic extends Model
{
    use HasFactory;

    protected $table = 'analytics';

    protected $fillable = [
        'session',
        'vcard_id',
        'uri',
        'source',
        'country',
        'state',
        'browser',
        'device',
        'operating_system',
        'ip',
        'language',
        'meta'
    ];
    
    public function vcard(): BelongsTo
    {
        return $this->belongsTo(Vcard::class, 'vcard_id', 'id');
    }
}
