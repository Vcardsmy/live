<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Models\VcardService
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $vcard_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Vcard $vcard
 * @method static \Illuminate\Database\Eloquent\Builder|VcardService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VcardService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VcardService query()
 * @method static \Illuminate\Database\Eloquent\Builder|VcardService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VcardService whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VcardService whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VcardService whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VcardService whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VcardService whereVcardId($value)
 * @mixin \Eloquent
 * @property-read mixed $service_icon
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|Media[] $media
 * @property-read int|null $media_count
 */
class VcardService extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'vcard_services';

    protected $appends = ['service_icon'];
    protected $with = ['media'];

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'vcard_id',
    ];

    /**
     * Validation rules
     * @var array
     */
    public static $rules = [
        'name'         => 'required|string|min:2',
        'description'  => 'string',
        'service_icon' => 'required|mimes:jpg,jpeg,png',
    ];

    const SERVICES_PATH = 'vcards/services';

    /**
     * @return mixed
     */
    public function getServiceIconAttribute()
    {
        /** @var Media $media */
        $media = $this->getMedia(self::SERVICES_PATH)->first();
        if (!empty($media)) {
            return $media->getFullUrl();
        }

        return asset('assets/images/default_service.png');
    }

    /**
     *
     * @return BelongsTo
     */
    public function vcard()
    {
        return $this->belongsTo(Vcard::class, 'vcard_id');
    }
}
