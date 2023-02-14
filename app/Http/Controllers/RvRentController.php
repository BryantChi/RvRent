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

    private $time_start_default = '';
    private $time_end_default = '';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rvModelInfo = RvModel::all();
        // $model_filter = array_filter($rvModelInfo->toArray(), function ($v) {
        //     $a = json_decode($v["rv_rent_setting"]);
        //     return count(array_filter($a, function ($vi) {
        //         return $vi->week == date('w');
        //     })) > 0 && $v["stock"] >= 0;
        // });
        // dd(json_decode(json_encode($model_filter)));
        $model_filter = array_filter($rvModelInfo->toArray(), function ($v) {
            return $v["stock"] >= 0;
        });
        $rvModelInfo = json_decode(json_encode($model_filter));
        $attachmentInfo = new \stdClass();
        $attachmentInfo->attachments = array();
        foreach ($rvModelInfo as $rvModel) {
            $attachmentInfo->attachments[$rvModel->id] = RvAttachmentRepository::getAttachment($rvModel->attachment_id);
        }
        return view('car_rent', ['title' => $this->title, 'pageInfo' => PageSettingInfo::getBanners('/car_rent'), 'rvModelInfo' => json_decode(json_encode($rvModelInfo)), 'attachmentInfo' => $attachmentInfo, 'date_get' => $this->time_start_default, 'date_back' => $this->time_end_default]);
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
        $rvModel = RvModel::find($id);
        $attachmentInfo = new \stdClass();
        $attachmentInfo->attachments = RvAttachmentRepository::getAttachment($rvModel->attachment_id);
        // dd($attachmentInfo);
        return view('car_rent_details', ['title' => $this->title, 'pageInfo' => PageSettingInfo::getBanners('/car_rent'), 'model' => $rvModel, 'attachmentInfo' => $attachmentInfo, 'date_get' => $this->time_start_default, 'date_back' => $this->time_end_default]);
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



    public function filterModelsDefault(Request $request)
    {
        $input = $request->all();
        $models = RvModel::all();
        $this->time_start_default = $input['date_get'];
        $this->time_end_default = $input['date_back'];

        $model_filter = array_filter($models->toArray(), function ($v) {
            $rv_rent_setting = json_decode($v["rv_rent_setting"]);
            if (!is_null($rv_rent_setting) || is_array($rv_rent_setting)) {
                return count(array_filter($rv_rent_setting, function ($vi) {
                    $week = date('w', strtotime($this->time_start_default));
                    $data_back = date('Y-m-d', strtotime('+' . $vi->day . ' day', strtotime($this->time_start_default))) . ' ' . $vi->back;

                    $firstDate  = new \DateTime($this->time_start_default);
                    $secondDate = new \DateTime($this->time_end_default);
                    $intvl = $secondDate->diff($firstDate);
                    // var_dump($intvl->d);

                    return $vi->week == $week && $intvl->d == $vi->day;
                    // strtotime($this->time_end_default) >= strtotime($data_back)
                })) > 0  && $v["stock"] > 0;
            }
        });
        $models = json_decode(json_encode($model_filter));
        $attachmentInfo = new \stdClass();
        $attachmentInfo->attachments = array();
        foreach ($models as $rvModel) {
            $attachmentInfo->attachments[$rvModel->id] = RvAttachmentRepository::getAttachment($rvModel->attachment_id);
        }

        if ($request->ajax()) {
            return \Response::json(\View::make('car_rent_items', array('rvModelInfo' => json_decode(json_encode($models)), 'attachmentInfo' => $attachmentInfo))->render());
        } else {
            return view('car_rent', ['title' => $this->title, 'pageInfo' => PageSettingInfo::getBanners('/car_rent'), 'rvModelInfo' => json_decode(json_encode($models)), 'attachmentInfo' => $attachmentInfo, 'date_get' => $this->time_start_default, 'date_back' => $this->time_end_default]);
        }


    }
}
