<?php

namespace App\Http\Controllers;

use App\DataTables\EnquiryDataTable;
use App\DataTables\VcardEnquiryDataTable;
use App\Http\Requests\CreateEnquiryRequest;
use App\Jobs\SendEmailJob;
use App\Mail\ContactUsMail;
use App\Models\Enquiry;
use App\Models\Vcard;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;

class EnquiryController extends AppBaseController
{

    /**
     * @param  CreateEnquiryRequest  $request
     * @param  Vcard  $vcard
     *
     * @return mixed
     */
    public function index(Request $request, $id){
        if ($request->ajax()){
            return Datatables::of((new EnquiryDataTable())->get($id))->make(true);
        }
        return view('enquiry.index');
    }

    public function store(CreateEnquiryRequest $request, Vcard $vcard)
    {
        $input = $request->all();
        $input['vcard_id'] = $vcard->id;
        Enquiry::create($input);
        $email = $vcard->email;

        if(!empty($email)){
            dispatch(new SendEmailJob($input, $email));
        }

        return $this->sendSuccess('Enquiry send successfully.');
    }

    /**
     * @param $id
     *
     * @return JsonResponse
     */
    public function show($id)
    {
        $enquiry = Enquiry::with('vcard')->where('id','=',$id)->first();
        return $this->sendResponse($enquiry, 'Testimonial successfully retrieved.');
    }

    /**
     * @param Request $request
     *
     * @throws \Exception
     *
     * @return Application|Factory|View
     */
    public function enquiryList(Request $request){

        if ($request->ajax()){
            return Datatables::of((new VcardEnquiryDataTable())->get())->make(true);
        }

        return view('enquiry.list');
    }
}
