<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAboutUsRequest;
use App\Models\AboutUs;
use App\Repositories\AboutUsRepository;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class AboutUsController extends Controller
{
    private $aboutUsRepository;

    /**
     * @param  AboutUsRepository  $aboutUsRepository
     */
    public function __construct(AboutUsRepository $aboutUsRepository)
    {
        $this->aboutUsRepository = $aboutUsRepository;
    }

    /**
     * @param  Request  $request
     *
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $aboutUs = AboutUs::with('media')->get();
        return view('sadmin.aboutUs.index', compact('aboutUs'));
    }

    /**
     * @param  CreateAboutUsRequest  $request
     *
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateAboutUsRequest $request)
    {
        $aboutUs = $this->aboutUsRepository->store($request->all());

        Flash::success(__('messages.flash.about_us_create'));

        return redirect(route('aboutUs.index'));
    }
}
