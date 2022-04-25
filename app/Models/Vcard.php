<?php

namespace App\Models;

use App\Traits\Multitenantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\Vcard
 *
 * @property int $id
 * @property string $url_alias
 * @property string $name
 * @property string $occupation
 * @property string $description
 * @property string|null $first_name
 * @property string|null $last_name
 * @property int $template_id
 * @property int $share_btn
 * @property int $status
 * @property string|null $company
 * @property string|null $job_title
 * @property string|null $dob
 * @property string $tenant_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $cover_url
 * @property-read mixed $profile_url
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Vcard newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vcard newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vcard query()
 * @method static \Illuminate\Database\Eloquent\Builder|Vcard whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vcard whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vcard whereTenantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vcard whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vcard whereDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vcard whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vcard whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vcard whereJobTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vcard whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vcard whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vcard whereOccupation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vcard whereShareBtn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vcard whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vcard whereTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vcard whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vcard whereUrlAlias($value)
 * @mixin \Eloquent
 * @property string|null $password
 * @property int $branding
 * @property string $font_family
 * @property string $font_size
 * @property string|null $custom_css
 * @property string|null $custom_js
 * @property-read string $template_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\VcardService[] $services
 * @property-read int|null $services_count
 * @property-read \App\Models\MultiTenant $tenant
 * @method static \Illuminate\Database\Eloquent\Builder|Vcard whereBranding($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vcard whereCustomCss($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vcard whereCustomJs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vcard whereFontFamily($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vcard whereFontSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vcard wherePassword($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Testimonial[] $testimonials
 * @property-read int|null $testimonials_count
 * @property-read \App\Models\SocialLink|null $socialLink
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Template[] $templates
 * @property-read int|null $templates_count
 * @property-read \App\Models\Template|null $template
 * @property string|null $email
 * @property float|null $phone
 * @property string|null $location
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BusinessHour[] $businessHours
 * @property-read int|null $business_hours_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subscription[] $subscriptions
 * @property-read int|null $subscriptions_count
 * @method static \Illuminate\Database\Eloquent\Builder|Vcard whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vcard whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vcard wherePhone($value)
 * @property string|null $region_code
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Enquiry[] $enquiry
 * @property-read int|null $enquiry_count
 * @method static \Illuminate\Database\Eloquent\Builder|Vcard whereRegionCode($value)
 */
class Vcard extends Model implements HasMedia
{
    use InteractsWithMedia, HasFactory, BelongsToTenant, Multitenantable;

    protected $table = 'vcards';

    /**
     * @var string[]
     */
    protected $fillable = [
        'url_alias',
        'name',
        'occupation',
        'description',
        'first_name',
        'last_name',
        'email',
        'region_code',
        'phone',
        'location',
        'location_url',
        'template_id',
        'share_btn',
        'company',
        'job_title',
        'dob',
        'password',
        'branding',
        'font_family',
        'font_size',
        'custom_css',
        'custom_js',
        'status',
        'tenant_id',
        'site_title',
        'home_title',
        'meta_keyword',
        'meta_description',
        'google_analytics'
    ];

    /**
     * @var string[]
     */
    protected $appends = ['profile_url', 'cover_url'];

    /**
     * Validation rules
     * @var array
     */
    public static $rules = [
        'url_alias'     => 'string|min:6|max:16|unique:vcards,url_alias',
        'name'          => 'string|min:2',
        'occupation'    => 'string',
        'first_name'    => 'string|min:2',
        'description'   => 'string',
        'last_name'     => 'string',
        'company'       => 'nullable|string',
        'job_title'     => 'nullable|string',
        'email'         => 'nullable|email:filter',
        'phone'         => 'nullable',
        'location_url'  =>  'nullable|url',
    ];

    const PROFILE_PATH = 'vcards/profiles';
    const COVER_PATH = 'vcards/covers';

    const TEMPLATE_1 = 1;
    const TEMPLATE_2 = 2;
    const TEMPLATE_3 = 3;
    const TEMPLATE_4 = 4;

    const TEMPLATE = [
        self::TEMPLATE_1,
        self::TEMPLATE_2,
        self::TEMPLATE_3,
        self::TEMPLATE_4,
    ];

    const TEMPLATE_URL = [
        self::TEMPLATE_1 => 'assets/images/default_cover_image.jpg',
        self::TEMPLATE_2 => 'assets/images/default_cover_image.jpg',
        self::TEMPLATE_3 => 'assets/images/default_cover_image.jpg',
        self::TEMPLATE_4 => 'assets/images/default_cover_image.jpg',
    ];

    const FONT_FAMILY = [
        'Poppins'         => 'Default',
        'Roboto'          => 'Roboto',
        'Times New Roman' => 'Times New Roman',
        'Open Sans'       => 'Open Sans',
        'Montserrat'      => 'Montserrat',
        'Lato'            => 'Lato',
        'Raleway'         => 'Raleway',
        'PT Sans'         => 'PT Sans',
        'Merriweather'    => 'Merriweather',
        'Prompt'          => 'Prompt',
        'Work Sans'       => 'Work Sans',
        'Concert One'     => 'Concert One',
    ];

    /**
     * @return mixed
     */
    public function getProfileUrlAttribute()
    {
        /** @var Media $media */
        $media = $this->getMedia(self::PROFILE_PATH)->first();
        if (!empty($media)) {
            return $media->getFullUrl();
        }

        return asset('web/media/avatars/150-26.jpg');
    }
    /**
     * @return mixed
     */
    public function getCoverUrlAttribute()
    {
        /** @var Media $media */
        $media = $this->getMedia(self::COVER_PATH)->first();
        if (!empty($media)) {
            return $media->getFullUrl();
        }

        return asset('assets/images/default_cover_image.jpg');
    }

    /**
     *
     * @return BelongsTo
     */
    public function template(): BelongsTo
    {
        return $this->belongsTo(Template::class, 'template_id');
    }

    /**
     *
     * @return HasMany
     */
    public function services(): HasMany
    {
        return $this->hasMany(VcardService::class, 'vcard_id');
    }

    /**
     * @return HasMany
     */
    public function gallery(): HasMany
    {
        return $this->hasMany(Gallery::class, 'vcard_id');
    }

    /**
     *
     *
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'vcard_id');
    }

    /**
     *
     * @return HasMany
     */
    public function testimonials(): HasMany
    {
        return $this->hasMany(Testimonial::class, 'vcard_id');
    }

    /**
     *
     * @return HasOne
     */
    public function socialLink(): HasOne
    {
        return $this->hasOne(SocialLink::class, 'vcard_id');
    }

    /**
     *
     * @return HasMany
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class, 'tenant_id', 'tenant_id');
    }

    /**
     *
     * @return HasMany
     */
    public function businessHours(): HasMany
    {
        return $this->hasMany(BusinessHour::class, 'vcard_id');
    }

    public function appointmentHours(): HasMany
    {
        return $this->hasMany(Appointment::class, 'vcard_id');
    }

    /**
     *
     * @return HasMany
     */
    public function enquiry(): HasMany
    {
        return $this->hasMany(Enquiry::class, 'vcard_id');
    }

    /**
     *
     *
     * @return HasMany
     */
    public function Analytics(): HasMany
    {
        return $this->hasMany(Analytic::class, 'vcard_id');
    }
}
