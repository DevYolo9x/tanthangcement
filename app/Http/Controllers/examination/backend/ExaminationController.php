<?php

namespace App\Http\Controllers\examination\backend;

use App\Http\Controllers\Controller;
use App\Models\Examination;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Components\Polylang;
use Illuminate\Validation\Rule;

class ExaminationController extends Controller
{
    protected $table = 'examinations';
    protected $Polylang;
    public function __construct()
    {
        $this->Polylang = new Polylang();
    }
    public function index(Request $request)
    {
        $dropdown = getFunctions();
        $data =  Examination::where('alanguage', config('app.locale'))->orderBy('id', 'DESC');
        
        $keyword = $request->keyword;
        if (!empty($keyword)) {
            $data =  $data->where('title', 'like', '%' . $keyword . '%');
        }
        $data =  $data->paginate(env('APP_paginate'));
        if (is($keyword)) {
            $data->appends(['keyword' => $keyword]);
        }
        $module = $this->table;
        return view('examination.backend.index', compact('module', 'data', 'module'));
    }
    public function create(Request $request)
    {
        $module = $this->table;
        $field = \App\Models\ConfigColum::where(['trash' => 0, 'publish' => 0, 'module' => $module])->get();
        return view('examination.backend.create', compact('module', 'field'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'examination_code' => 'required|unique:examinations,examination_code',
            // 'slug' =>  ['required', Rule::unique('router')->where(function ($query) {
            //     return $query->where('alanguage', config('app.locale'));
            // })],
            'examination_date' => 'required',
            'date_of_result' => 'required',
            'date_of_return' => 'required',
            'examination_pass' => 'required',
        ], [
            'fullname.required' => 'Họ và tên là trường bắt buộc.',
            'examination_code.required' => 'Mã tra cứu là trường bắt buộc.',
            'examination_code.unique' => 'Mã tra cứu đã tồn tại.',
            // 'slug.required' => 'Đường dẫn là trường bắt buộc.',
            // 'slug.unique' => 'Đường dẫn đã tồn tại.',
            'examination_date.required' => 'Ngày khám là trường bắt buộc.',
            'date_of_result.required' => 'Ngày nhận kết quả là trường bắt buộc.',
            'date_of_return.required' => 'Ngày trả kết quả là trường bắt buộc.',
            'examination_pass.required' => 'Mật khẩu là trường bắt buộc.',
        ]);
        //upload image
        if (!empty($request->file('image'))) {
            $image_url = uploadImage($request->file('image'), $this->table);
        } else {
            $image_url = $request->image_old;
        }
        //end
        //upload image
        if (!empty($request->file('banner'))) {
            $banner_url = uploadImage($request->file('banner'), $this->table);
        } else {
            $banner_url = $request->banner_old;
        }
        //end
        $this->submitPage($request, 'create', 0, $image_url, $banner_url);
        return redirect()->route('examinations.index')->with('success', "Thêm mới tra cứu thành công");
    }
    public function edit($id)
    {
        $module = $this->table;
        $detail  = Examination::where('alanguage', config('app.locale'))->find($id);
        if (!isset($detail)) {
            return redirect()->route('examinations.index')->with('error', "Tra cứu không tồn tại");
        }
        $field = \App\Models\ConfigColum::where(['trash' => 0, 'publish' => 0, 'module' => $module])->get();
        return view('examination.backend.edit', compact('module', 'detail', 'field'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'fullname' => 'required',
            'examination_code' => 'required',
            'examination_date' => 'required',
            'date_of_result' => 'required',
            'date_of_return' => 'required',
            'examination_pass' => 'required',
        ], [
            'fullname.required' => 'Họ và tên là trường bắt buộc.',
            'examination_code.required' => 'Mã tra cứu là trường bắt buộc.',
            'examination_date.required' => 'Ngày khám là trường bắt buộc.',
            'date_of_result.required' => 'Ngày nhận kết quả là trường bắt buộc.',
            'date_of_return.required' => 'Ngày trả kết quả là trường bắt buộc.',
            'examination_pass.required' => 'Mật khẩu là trường bắt buộc.',
        ]);

        //upload image
        if (!empty($request->file('image'))) {
            $image_url = uploadImage($request->file('image'), $this->table);
        } else {
            $image_url = $request->image_old;
        }
        //end
        //upload image
        if (!empty($request->file('banner'))) {
            $banner_url = uploadImage($request->file('banner'), $this->table);
        } else {
            $banner_url = $request->banner_old;
        }
        //end

        $this->submitPage($request, 'update', $id, $image_url, $banner_url);
        return redirect()->route('examinations.index')->with('success', "Cập nhập tra cứu thành công");
    }
    public function submitPage($request = [], $action = '', $id = 0, $image_url = '', $banner_url = '')
    {
        if ($action == 'create') {
            $time = 'created_at';
            $user = 'userid_created';
        } else {
            $time = 'updated_at';
            $user = 'userid_updated';
        }
        $examinationDate = join('-', array_reverse(explode('-', $request['examination_date']), true));
        $dateOfResult = join('-', array_reverse(explode('-', $request['date_of_result']), true));
        $dateOfReturn = join('-', array_reverse(explode('-', $request['date_of_return']), true));
        $_data = [
            'fullname' => $request['fullname'],
            //'slug' => $request['slug'],
            'examination_code' => $request['examination_code'],
            'examination_pass' => $request['examination_pass'],
            'examination_date' => $examinationDate,
            'date_of_result' => $dateOfResult,
            'date_of_return' => $dateOfReturn,
            'image' => $image_url,
            'description' => $request['description'],
            'status' => $request['status'],
            'meta_title' => $request['meta_title'],
            'meta_description' => $request['meta_description'],
            'publish' => $request['publish'],
            $user => Auth::user()->id,
            $time => Carbon::now(),
            'alanguage' => config('app.locale'),
        ];
        if ($action == 'create') {
            $id = Examination::insertGetId($_data);
        } else {
            Examination::find($id)->update($_data);
        }
        if (!empty($id)) {
            //xóa khi cập nhập
            if ($action == 'update') {
                //xoá router
                //DB::table('router')->where(['moduleid' => $id, 'module' => $this->table])->delete();
                //xóa custom fields
                DB::table('config_postmetas')->where(['module_id' => $id, 'module' => $this->table])->delete();
                $this->Polylang->insert($this->table, $request['language'], $id);
            }

            //thêm router
            // DB::table('router')->insert([
            //     'moduleid' => $id,
            //     'module' => $this->table,
            //     'slug' => $request['slug'],
            //     'created_at' => Carbon::now(),
            //     'alanguage' => config('app.locale'),
            // ]);
            //START: custom fields
            fieldsInsert($this->table, $id, $request);
            //END
        }
    }
}
