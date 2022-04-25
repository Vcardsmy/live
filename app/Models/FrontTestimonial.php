<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Models\FrontTestimonial
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $testimonial_url
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|FrontTestimonial newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontTestimonial newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontTestimonial query()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontTestimonial whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontTestimonial whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontTestimonial whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontTestimonial whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontTestimonial whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FrontTestimonial extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'front_testimonials';

    protected $fillable = [
        'name',
        'description',
    ];

    const PATH = 'testimonials';

    protected $appends = ['testimonial_url'];

    public static $rules = [
        'name'        => 'string|min:2',
        'description' => 'string',
        'image'       => 'required|mimes:jpg,jpeg,png',
    ];

    public function getTestimonialUrlAttribute(): string
    {
        /** @var Media $media */
        $media = $this->getMedia(self::PATH)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return asset('assets/img/testimonials/male.jpeg');
    }

}
