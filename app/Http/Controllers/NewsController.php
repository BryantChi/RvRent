<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsInfo as NewsInfo;
use App\Admin\Repositories\PageSettingInfo as PageSettingRepository;

class NewsController extends Controller
{
    protected $title = '最新消息';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $newInfo = NewsInfo::orderBy('updated_at', 'desc')->limit(15)->get();
        return view('news', ['newInfo' => $newInfo, 'title' => $this->title, 'pageInfo' => $this->getBanner()]);
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
        $newsInfo = NewsInfo::find($id);
        return view('news-details', ['newsInfo' => $newsInfo, 'title' => $this->title, 'pageInfo' => $this->getBanner()]);
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

    function getBanner() {
        return PageSettingRepository::getBanners('/news');
    }
}
