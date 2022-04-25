<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Models\Template
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|Template newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Template newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Template query()
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read string $template_url
 * @property-read \App\Models\Vcard|null $vcard
 * @property-read mixed $user_count
 */
class Template extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'templates';

    protected $fillable = [
        'name',
        'path'
    ];
    
    protected $with = ['media'];
    protected $appends = ['template_url', 'user_count'];

    const TEMPLATE_PATH = 'template';

    /**
     *
     * @return HasOne
     */
    public function vcard(): HasOne
    {
       return $this->hasOne(Vcard::class, 'template_id');
    }

    /**
     *
     * @return string
     */
    public function getTemplateUrlAttribute(): string
    {
        return asset($this->path);
    }

    /**
     *
     *
     * @return mixed
     */
    public function getUserCountAttribute()
    {
        return Vcard::where('template_id', $this->id)->count();
    }
}
