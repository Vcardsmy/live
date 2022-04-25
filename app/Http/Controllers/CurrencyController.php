<?php

namespace App\Http\Controllers;

use DataTables;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CurrencyController extends AppBaseController
{
    /**
     * @param Request $request
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('sadmin.currencies.index');
    }
}
