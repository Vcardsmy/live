<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PlanTemplate
 *
 * @property int $id
 * @property int $plan_id
 * @property int $template_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PlanTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanTemplate wherePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanTemplate whereTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanTemplate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PlanTemplate extends Model
{
    use HasFactory;
    
    protected $table = 'plan_template';
}
