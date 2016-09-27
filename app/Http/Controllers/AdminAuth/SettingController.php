<?php

namespace App\Http\Controllers\AdminAuth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;


class SettingController extends Controller
{
    public function getSetting()
    {
        if (Auth::guard('admin')->check()) {
            $admin_id = Auth::guard('admin')->user()->id;
            $settings = DB::table('settings')->where('index', '0')->get();
            if($settings[0]->file_dir == null){
                DB::table('settings')->where('index', '0')->update(['file_dir' => '../']);
                $settings = DB::table('settings')->where('index', '0')->get();
                return view('admin.auth.setting', ['settings' => $settings, 'admin_id' => $admin_id]);
            }
            else{
                return view('admin.auth.setting', ['settings' => $settings, 'admin_id' => $admin_id]);
            }
        } else {
            return Redirect::to('admin/login');
        }
    }


    public function postUpdate(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            DB::table('settings')->where('index', '0')->update(['allow_admin_register' => $request->allow]);
            $allow_admin_register = DB::table('settings')->where('index', '0')->get();
            return view('admin.auth.setting', ['allow_admin_register' => $allow_admin_register]);
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function postAdminVerify()
    {
        if (Auth::guard('admin')->check()) {
            $pattern = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $key = "";
            for ($i = 0; $i < 8; $i++) {
                $key .= $pattern{rand(0, 61)};
            }

            DB::table('admin_verify_codes')->insert(['verify' => $key]);

            return Redirect::back()->with('admin_verify', $key);
        } else {
            return Redirect::to('admin/login');
        }
    }
    
    public function fileDir(Request $request){
        DB::table('settings')->where('index', '0')->update(['file_dir' => $request->file_dir]);
        $settings = DB::table('settings')->where('index', '0')->get();
        return view('admin.auth.setting', ['settings' => $settings]);
    }
}
