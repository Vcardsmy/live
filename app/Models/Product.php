<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'products';

    protected $appends = ['product_icon'];
    protected $with = ['media'];

    protected $fillable = [
        'name',
        'currency_id',
        'price',
        'description',
        'vcard_id',
    ];

    public static $rules = [
        'name'         => 'required|string|min:2',
        'price'        => 'nullable|numeric|min:0',
        'description'  => 'string|min:2|max:200',
        'product_icon' => 'required|mimes:jpg,jpeg,png',
    ];

    const PRODUCT_PATH = 'vcards/products';

    /**
     *
     *
     * @return string
     */
    public function getProductIconAttribute()
    {
        /** @var Media $media */
        $media = $this->getMedia(self::PRODUCT_PATH)->first();
        if (!empty($media)) {
            return $media->getFullUrl();
        }
        return asset('assets/images/default_service.png');
    }

    /**
     *
     *
     * @return BelongsTo
     */
    public function vcard()
    {
        return $this->belongsTo(Vcard::class, 'vcard_id');
    }

    /**
     *
     *
     * @return BelongsTo
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
}
