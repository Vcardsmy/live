<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\VcardTemplate
 *
 * @property int $id
 * @property int $vcard_id
 * @property int $template_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|VcardTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VcardTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VcardTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|VcardTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VcardTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VcardTemplate whereTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VcardTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VcardTemplate whereVcardId($value)
 * @mixin \Eloquent
 */
class VcardTemplate extends Model
{
    use HasFactory;
    
    protected $table = 'vcard_template';
}
