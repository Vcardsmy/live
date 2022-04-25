<?php

namespace App\DataTables;

use App\Models\Template;
use App\Models\Vcard;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class VcardDataTable
 */
class VcardDataTable
{
    /**
     * @return Vcard
     */
    public function get()
    {
        /** @var Vcard $vcard */
        $vcard = Vcard::with(['tenant.user', 'template'])->select('vcards.*');
        return $vcard;
    }


    /**
     *
     *
     * @return Builder[]|Collection
     */
    public function getTemplates()
    {
        return Template::with('vcard')->get();
    }
}
