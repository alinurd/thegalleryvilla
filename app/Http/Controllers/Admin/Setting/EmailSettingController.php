<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use Illuminate\Http\Request;

class EmailSettingController extends Controller
{
    public function index()
    {
        $data['data'] = AppSetting::first();

        return view("admin.setting.emailsetting.index",$data);
    }

    public function saveSetting(Request $request)
    {
        $data = $request->only([
            'email_template',
        ]); 
        $appSettingCount = AppSetting::count();
        if($appSettingCount == 0) {
            $data['created_at'] = date('Y-m-d H:i:s');
            AppSetting::create($data);
        } else {
            $appSetting = AppSetting::first();
            $data['updated_at'] = date('Y-m-d H:i:s');
            AppSetting::where('id', $appSetting->id)->update($data);
        }
        return response()->json(['status'=>'success', 'message' => 'Settings Saved!']);



    }
}
