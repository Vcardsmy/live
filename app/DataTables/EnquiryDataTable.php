<?php

namespace App\DataTables;


use App\Models\Enquiry;

/**
 * Class TestimonialDataTable
 */
class EnquiryDataTable
{
    /**
     * @param $id
     *
     * @return Enquiry
     */
    public function get($id)
        
    {
        return Enquiry::whereVcardId($id)->select('enquiries.*');
    }
}
