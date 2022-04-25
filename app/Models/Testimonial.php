<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Models\Testimonial
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $vcard_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $image_url
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @property-read \App\Models\Vcard $vcard
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial query()
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereVcardId($value)
 * @mixin \Eloquent
 */
class Testimonial extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'testimonials';

    protected $appends = ['image_url'];
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
        'name'        => 'string|min:2',
        'description' => 'string',
        'image'       => 'required|mimes:jpg,jpeg,png',
    ];

    const TESTIMONIAL_PATH = 'vcards/testimonials';

    /**
     * @return mixed
     */
    public function getImageUrlAttribute()
    {
        /** @var Media $media */
        $media = $this->getMedia(self::TESTIMONIAL_PATH)->first();
        if (!empty($media)) {
            return $media->getFullUrl();
        }

        return asset('web/media/avatars/150-2.jpg');
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
