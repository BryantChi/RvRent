<?php

namespace App\Http\Controllers;

use App\Admin\Repositories\PageSettingInfo;
use App\Models\AboutUsInfo;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $aboutUsInfo = AboutUsInfo::first();
        return view('about', ['title' => '關於我們', 'pageInfo' => PageSettingInfo::getBanners('/about'), 'aboutUsInfo' => $aboutUsInfo]);
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
     * @param  \App\Models\AboutUsInfo  $aboutUsInfo
     * @return \Illuminate\Http\Response
     */
    public function show(AboutUsInfo $aboutUsInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AboutUsInfo  $aboutUsInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(AboutUsInfo $aboutUsInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AboutUsInfo  $aboutUsInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AboutUsInfo $aboutUsInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AboutUsInfo  $aboutUsInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(AboutUsInfo $aboutUsInfo)
    {
        //
    }
}
