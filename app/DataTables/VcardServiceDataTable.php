<?php

namespace App\DataTables;


use App\Models\VcardService;

/**
 * Class VcardServiceDataTable
 */
class VcardServiceDataTable
{
    /**
     * @param $id
     *
     * @return VcardService
     */
    public function get($id)
    {
        return VcardService::whereVcardId($id)->select('vcard_services.*');
    }
}
