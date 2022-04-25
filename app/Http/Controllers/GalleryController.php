<?php

namespace App\Http\Controllers;

use App\DataTables\GalleryDatatable;
use App\Http\Requests\CreateGalleryRequest;
use App\Models\Gallery;
use App\Repositories\GalleryRepository;
use Illuminate\Http\Request;
use DataTables;


class GalleryController extends AppBaseController
{

    /**
     * @var GalleryRepository
     */
    private $galleryRepo;

    /**

     * @param GalleryRepository $galleryRepo
     */
    public function __construct(GalleryRepository $galleryRepo)
    {
        $this->galleryRepo = $galleryRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id)
    {
        if($request->ajax()) {
           return Datatables::of((new GalleryDatatable())->get($id))->make(true);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateGalleryRequest $request)
    {
        $input = $request->all();

        $this->galleryRepo->store($input);

        return $this->sendSuccess('Gallery created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        return $this->sendResponse($gallery, 'Gallery  successfully retrieved.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateGalleryRequest $request,Gallery $gallery)
    {
        $input = $request->all();
        $this->galleryRepo->update($input, $gallery->id);

        return $this->sendSuccess('Gallery updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(gallery $gallery)
    {
        $gallery->clearMediaCollection(GALLERY::GALLERY_PATH);
        $gallery->delete();

        return $this->sendSuccess('VCard service deleted successfully.');
    }
}
