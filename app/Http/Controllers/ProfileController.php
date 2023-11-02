<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:80',
            'IDNumber' => [
                'required',
                'regex:/^[A-Z]{1,2}[0-9]{8,9}$/'
            ],
            'nick_name' => 'max:80',
            'country' => 'required|max:80',
            'phone' => [
                'required', 'max:10',
                'regex:/(\d{2,3}-?|\(\d{2,3}\))\d{3,4}-?\d{4}|09\d{2}(\d{6}|-\d{3}-\d{3})/'
            ],
            'line_id' => 'required|max:80',
            'gender' => 'required',
            'date' => 'date',
            'driving_licence' => 'nullable|image|max:1024'
        ], [
            'name.required' => '請填寫名稱',
            'name.max' => '最大長度80字',
            'IDNumber.required' => '請填寫身分證字號或居留證',
            'IDNumber.regex' => '身分證或居留證格式錯誤',
            'nick_name.max' => '最大長度80字',
            'country.required' => '請填寫國家',
            'country.max' => '最大長度80字',
            'phone.required' => '請填寫電話',
            'phone.max' => '電話超過長度',
            'phone.regex' => '電話格式錯誤',
            'line_id.required' => '請填寫LineID',
            'line_id.max' => '最大長度80字',
            'date.date' => '日期格式錯誤',
            'driving_licence.image' => '圖檔格式錯誤，僅支援 jpg, jpeg, png, bmp, gif, svg, or webp 格式的圖片',
            'driving_licence.max' => '圖檔大小不可超過1MB'
        ]);


        if ($validator->fails()) {
            return redirect('member_center/profile')
                ->withErrors($validator)
                ->withInput();
        }

        $input = $request->all();
        $user_info = User::find($user);
        $user_info->name = $input['name'];
        $user_info->IDNumber = $input['IDNumber'];
        $user_info->nick_name = $input['nick_name'];
        $user_info->country = $input['country'];
        $user_info->phone = $input['phone'];
        $user_info->line_id = $input['line_id'];
        $user_info->gender = $input['gender'];
        $user_info->birthday = $input['date'];
        $image = $request->file('driving_licence');

        if ($image) {
            $filename = time() . '_' . $user . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/images/user_driving_licence/' . $user . '/photos'), $filename);

            if ($user_info->driving_licence != null) {
                // 若已存在，則覆蓋原有圖片
                if (File::exists(public_path('uploads/' . $user_info->driving_licence))) {
                    File::delete(public_path('uploads/' . $user_info->driving_licence));
                }
            }
            $user_info->driving_licence = 'images/user_driving_licence/' . $user . '/photos/' . $filename;
        }

        $user_info->save();

        return redirect('member_center/profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
