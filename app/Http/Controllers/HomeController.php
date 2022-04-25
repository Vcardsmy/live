<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContactRequest;
use App\Models\AboutUs;
use App\Models\ContactUs;
use App\Models\Feature;
use App\Models\FrontTestimonial;
use App\Models\Meta;
use App\Models\Plan;
use App\Models\Setting;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends AppBaseController
{
    /**
     *
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $testimonials = FrontTestimonial::with('media')->get();
        
        $metas = Meta::first();
        
       if (!empty($metas)){
           $metas = $metas->toArray();
       }
        
        $setting = Setting::pluck('value', 'key')->toArray();

        $aboutUS = AboutUs::with('media')->get()->toArray();

        $features = Feature::all();

        $plans = Plan::with(['currency','planFeature'])->get();

        return view('front.home.home', compact('plans', 'setting', 'features', 'testimonials', 'aboutUS', 'metas'));
    }

    public function store(CreateContactRequest $request)
    {
        $input = $request->all();

        ContactUs::create($input);

        return $this->sendSuccess('Message send successfully.');
    }

    /**
     * @param  Request  $request
     *
     * @return Application|Factory|View
     * @throws \Exception
     *
     */
    public function showContactUs()
    {
        return view('sadmin.contactus.index');
    }
    public function changeLanguage(Request $request)
    {
        Session::put('languageName', $request->input('languageName'));

        return redirect()->back();
    }

}
