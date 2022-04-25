<?php

namespace App\DataTables;


use App\Models\Enquiry;
use App\Models\Vcard;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class VcardEnquiryDataTable
 */
class VcardEnquiryDataTable
{
    /**
     * @return Builder[]|Collection
     */
    public function get()
    {
        $vcardIds = Vcard::whereTenantId(getLogInTenantId())->pluck('id')->toArray();
        
        return Enquiry::with('vcard')->whereIn('vcard_id',$vcardIds)->get();
    }
}
