<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\SocialLink
 *
 * @property int $id
 * @property int $vcard_id
 * @property string|null $website
 * @property string|null $twitter
 * @property string|null $facebook
 * @property string|null $instagram
 * @property string|null $youtube
 * @property string|null $messenger
 * @property string|null $tiktok
 * @property string|null $linkedin
 * @property string|null $whatsapp
 * @property string|null $pinterest
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Vcard $vcard
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLink newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLink newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLink query()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLink whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLink whereFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLink whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLink whereInstagram($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLink whereLinkedin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLink whereMessenger($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLink wherePinterest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLink whereTiktok($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLink whereTwitter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLink whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLink whereVcardId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLink whereWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLink whereWhatsapp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLink whereYoutube($value)
 * @mixin \Eloquent
 * @property string|null $reddit
 * @property string|null $tumblr
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLink whereReddit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLink whereTumblr($value)
 */
class SocialLink extends Model
{
    use HasFactory;
    
    protected $table = 'social_links';

    /**
     * @var string[] 
     */
    protected $fillable = [
        'vcard_id',
        'website',
        'twitter',
        'facebook',
        'instagram',
        'youtube',
        'tumblr',
        'reddit',
        'linkedin',
        'whatsapp',
        'pinterest',
        'tiktok',
    ];

    /**
     *
     * @return BelongsTo
     */
    public function vcard()
    {
        return $this->belongsTo(Vcard::class, 'vcard_id');
    }
}
