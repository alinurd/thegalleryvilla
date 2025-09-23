<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AppSetting;

class AppSettingController extends Controller
{
    public function index()
    {
        $data['data'] = AppSetting::first();

        return view("admin.setting.appsetting.index",$data);
    }

    public function saveSetting(Request $request)
    {
        $data = $request->only([
            'title', 'telephone', 'mobile_phone', 'email', 'address', 'contactus', 'latitude', 'longitude', 'footer_text',
            'logo', 'logo_footer', 'favicon', 'meta_keyword', 'meta_description', 'whatsapp', 'website',
            'facebook', 'status_facebook', 'twitter', 'status_twitter', 'youtube', 'status_youtube',
            'tiktok', 'status_tiktok', 'instagram', 'status_instagram'
        ]);
        if(!empty($data['logo'])) {
            $data['logo'] = str_replace(url('/').'/', '', $data['logo']);
        }
        if(!empty($data['logo_footer'])) {
            $data['logo_footer'] = str_replace(url('/').'/', '', $data['logo_footer']);
        }
        if(!empty($data['favicon'])) {
            $data['favicon'] = str_replace(url('/').'/', '', $data['favicon']);
        }

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
