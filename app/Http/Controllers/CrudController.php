<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class CrudController extends Controller
{

    public function index(Request $request) {
        $model_name = '\\App\\Models\\'.$request->model;
        $model = new $model_name;
        $kuthe = isset($request->kuthe) ? $request->kuthe : 'Anywhere';
        $kay = isset($request->kay) ? $request->kay : 'id';
        $shodha = isset($request->shodha) ? $request->shodha : null;
        $keys = explode(',', $kay);
        $query = $model::query();
        if( isset($request->shodha)){
            if(sizeof($keys) > 1){
                switch($kuthe){
                    case "Anywhere":
                        $query = $query->whereHas($keys[0], function($q) use($keys, $shodha){
                            $q->where($keys[1], 'like', '%' . $shodha . '%');
                        });
                    break;
                    case "Exact":
                        $query = $query->whereHas($keys[0], function($q) use($keys, $shodha){
                            $q->where($keys[1], $shodha);
                        });
                    break;
                }
            } else {
                switch($kuthe){
                    case "Anywhere": $query = $query->where($kay, 'like', '%' . $shodha . '%'); break;
                    case "Exact": $query = $query->where($kay, $shodha); break;
                }
            }
        }
        
        if( strlen($request->with) > 0){
            $withs = explode(',', $request->with);
            $query = $query->with($withs);
        }

        $r = explode(',', $request->order_by);
        if(sizeof($r) > 1){
            $query = $query->where(function ($qq) use($r, $request) {
                $qq->whereHas($r[0], function ($q) use($r, $request) {
                    $q->orderBy($r[1], $request->order);
                });
                
            });
        } else {
            $query = $query->orderBy($request->order_by, $request->order);
        }

        if(isset($request->where)){
            $w = explode(',', $request->where);
            $s = sizeof($w);
            $m = $s % 3;
            $l = $s/3;

            if($m == 0){
                for($i = 0; $i < $l; $i++){
                    $query = $query->where($w[0], $w[1], $w[2]);
                }
            }
        }

        if(isset($request->whereHas)){
            $w = explode(',', $request->whereHas);
            $s = sizeof($w);
            if($s == 3){
                $query = $query->whereHas($w[0], function($q) use($w){
                    $q->where($w[1], $w[2]);
                });
            }
        }


        $data = $query->simplePaginate($request->rows);
        return $data;
    }

    public function save(Request $request) {

        /* Validating Fields */
        $data = [];
        foreach($request->table as $field){
            if($field['validation'] != null && $field['validation'] != ''){
                $data[$field['field']] = $field['validation'];
            }
        }
        $request->validate($data);

        /* Changed data to array */
        $input = $request->all();

        /* Encrypt if field is password */
        if(isset($input["password"])){
            $input["password"] = bcrypt($input["password"]);
        }

        /* Setting User Id */
        if(!isset($input["user_id"])){
            $input["user_id"] = Auth::id();
        }

        /* Files Handeling */
        foreach($input as $k => $v){
            if(gettype($v) == "object"){
                if($file = $request->file($k)){
                    $name = time().'_'.mt_rand(100000,999999).'_'.$file->getClientOriginalName();
                    $file->move($input["model"], $name);
                    $input[$k] = "/".$input["model"]."/".$name;
                    if($input["id"] != null){
                        $model_name = '\\App\\Models\\'.$request->model;
                        $model = new $model_name;
                        $fl = $model->find($input["id"])[$k];
                        if($fl != null || $fl != ""){
                            if(file_exists(substr($fl, 1))){
                                unlink(substr($fl, 1));
                            }
                        }
                    }
                }
            }
        }

        /* Remove all non-required fields */
        unset($input['model']);
        unset($input['files']);
        unset($input['table']);

        /* Saving Data */
        $model_name = '\\App\\Models\\'.$request->model;
        $model = new $model_name;
        if( $input["id"] == 0){
            $crud = $model->create($input);
        } else {
            $model->find($input["id"])->update($input);
        }

        return back();

    }

    public function delete(Request $request) {

        $files = explode("," ,$request->all()["files"]);

        foreach($files as $file){
            $model_name = '\\App\\Models\\'.$request->model;
            $model = new $model_name;
            $fl = $model->find($request->id)[$file];
            if($fl != null || $fl != ""){
                if(file_exists(substr($fl, 1))){
                    unlink(substr($fl, 1));
                }
            }
        }
        $model_name = '\\App\\Models\\'.$request->model;
        $model = new $model_name;

        $model->find($request->id)->delete();

        return back();
    }
}
