<?php

namespace App\Http\Controllers\patient\backend;

use App\Components\Nestedsetbie;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\PatientLog;
use App\Models\Patient_payments;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Components\Helper;
use App\Components\Polylang;
use App\Models\CategoryPatient;
use App\Models\Tag;
use Illuminate\Validation\Rule;
use App\Http\Requests\PostRequest;
use App\Components\InventoryPatient;

class PatientOrderController extends Controller
{
    protected $Nestedsetbie;
    protected $Helper;
    protected $Polylang;
    protected $table = 'patient_payments';
    public function __construct()
    {
        $this->Helper = new Helper();
        $this->Polylang = new Polylang();
        $this->iventory = new InventoryPatient();
    }
    public function index(Request $request)
    {
        $module = $this->table;
        $data =  Patient_payments::orderBy('id', 'DESC');
        $keyword = $request->keyword;
        if (!empty($keyword)) {
            $data =  $data->where($this->table . '.name', 'like', '%' . $keyword . '%');
        }
        $data =  $data->paginate(env('APP_paginate'));
        if (is($keyword)) {
            $data->appends(['keyword' => $keyword]);
        }
        $configIs = \App\Models\Configis::select('title', 'type')->where(['module' => $this->table, 'active' => 1])->get();
        return view('patient.backend.payment.index', compact('data', 'module', 'configIs'));
    }
}
