<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\PlanFeature
 *
 * @property int $id
 * @property int $plan_id
 * @property int $multiple_themes
 * @property int $custom_fields
 * @property int $products_services
 * @property int $portfolio
 * @property int $gallery
 * @property int $qrcode
 * @property int $testimonials
 * @property int $hide_branding
 * @property int $enquiry_form
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Plan $plan
 * @method static \Illuminate\Database\Eloquent\Builder|PlanFeature newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanFeature newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanFeature query()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanFeature whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanFeature whereCustomFields($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanFeature whereEnquiryForm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanFeature whereGallery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanFeature whereHideBranding($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanFeature whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanFeature whereMultipleThemes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanFeature wherePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanFeature wherePortfolio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanFeature whereProductsServices($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanFeature whereQrcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanFeature whereTestimonials($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanFeature whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $analytics
 * @property int $password
 * @property int $custom_css
 * @property int $custom_js
 * @method static \Illuminate\Database\Eloquent\Builder|PlanFeature whereAnalytics($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanFeature whereCustomCss($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanFeature whereCustomJs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanFeature wherePassword($value)
 * @property int $social_links
 * @property int $custom_fonts
 * @method static \Illuminate\Database\Eloquent\Builder|PlanFeature whereCustomFonts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanFeature whereSocialLinks($value)
 */
class PlanFeature extends Model
{
    use HasFactory;

    protected $table = 'plan_features';

    /**
     * @var array
     */
    protected $fillable = [
        'plan_id',
        'products_services',
        'testimonials',
        'hide_branding',
        'enquiry_form',
        'social_links',
        'password',
        'custom_css',
        'custom_js',
        'custom_fonts',
        'products',
        'appointments',
        'gallery',
        'analytics',
        'seo'
    ];

    /**
     *
     * @return BelongsTo
     */
    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }
}
