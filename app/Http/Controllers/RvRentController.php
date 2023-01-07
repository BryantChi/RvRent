<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RvModelInfo as RvModel;
use App\Models\RvSeriesInfo as RvSeries;
use App\Models\RvAttachmentInfo as RvAttachment;
use App\Models\RvVehicleInfo as RvVehicle;
use App\Admin\Repositories\PageSettingInfo;
use App\Admin\Repositories\RvAttachmentInfo as RvAttachmentRepository;

class RvRentController extends Controller
{
    protected $title = '即刻租車';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rvModelInfo = RvModel::all();
        $attachmentInfo = new \stdClass();
        $attachmentInfo->attachments = array();
        foreach ($rvModelInfo as $rvModel) {
            $attachmentInfo->attachments[$rvModel->id] = RvAttachmentRepository::getAttachment($rvModel->attachment_id);
        }
        return view('car_rent', ['title' => $this->title, 'pageInfo' => PageSettingInfo::getBanners('/car_rent'), 'rvModelInfo' => $rvModelInfo, 'attachmentInfo' => $attachmentInfo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
