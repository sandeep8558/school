<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Setting;

class SettingController extends Controller
{

    public function settings() {
        /* Fetch all settings */
        $mysettings = Setting::all();
        return Inertia::render('Administrator/Settings', compact('mysettings'));
    }

    public function settings_update(Request $request){
        /*
        Check is sent data is object or text
        If data is object the uploads file
        */
        if(gettype($request->val) == "object"){
            if($file = $request->file('val')){
                $name = time().'_'.mt_rand(100000,999999).'_'.$file->getClientOriginalName();
                $file->move('images', $name);
                $request->val = "/images/".$name;
            }
        }

        /* Checks settings exists or not */
        $q = Setting::where('key', $request->key)->exists();
        if($q){

            /* Here if we finds file then we delete existing file */
            $fl = Setting::where('key', $request->key)->first()->val;
            if($fl != null || $fl != ""){
                if(file_exists(substr($fl, 1))){
                    unlink(substr($fl, 1));
                }
            }

            /* Updates data */
            Setting::where('key', $request->key)->update([
                'val' => $request->val
            ]);

        } else {

            /* Create new setting entry */
            Setting::create([
                'key' => $request->key,
                'val' => $request->val
            ]);

        }

        /* Redirect back to origin page */
        return back();
    }
}
