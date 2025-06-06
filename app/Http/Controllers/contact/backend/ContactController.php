<?php

namespace App\Http\Controllers\contact\backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Contact::where('type', 'contact')->orderBy('id', 'DESC');
        if (is($request->keyword)) {
            $data =  $data->where(function ($query) use ($request) {
                $query->where('email', 'like', '%' . $request->keyword . '%')
                    ->orWhere('fullname', 'like', '%' . $request->keyword . '%')
                    ->orWhere('phone', 'like', '%' . $request->keyword . '%');
            });
        }
        $data = $data->paginate(env('APP_paginate'));
        if (is($request->keyword)) {
            $data->appends(['keyword' => $request->keyword]);
        }
        if (is($request->type)) {
            $data->appends(['type' => $request->type]);
        }
        $countContact = Contact::where('type', 'contact')->count();
        $countEmail = Contact::where('type', 'mail')->count();

        //lấy toàn bộ email
        $array_email = Contact::groupBy('email')->get();
        if (isset($array_email)) {
            $temp_email[] = '';
            foreach ($array_email as $val) {
                $temp_email[$val->email] = $val->email;
            }
        }
        $module =  'contacts';
        return view('contact.backend.index', compact('module', 'data', 'countContact', 'countEmail', 'temp_email'));
    }
    
    public function register(Request $request)
    {
        $data = Contact::where('type', 'register')->orderBy('id', 'DESC');
        if (is($request->keyword)) {
            $data =  $data->where(function ($query) use ($request) {
                $query->where('email', 'like', '%' . $request->keyword . '%')
                    ->orWhere('fullname', 'like', '%' . $request->keyword . '%')
                    ->orWhere('phone', 'like', '%' . $request->keyword . '%');
            });
        }
        $data = $data->paginate(env('APP_paginate'));
        if (is($request->keyword)) {
            $data->appends(['keyword' => $request->keyword]);
        }
        if (is($request->type)) {
            $data->appends(['type' => $request->type]);
        }
        $countContact = Contact::where('type', 'register')->count();
        $countEmail = Contact::where('type', 'register')->count();

        //lấy toàn bộ email
        $array_email = Contact::groupBy('email')->get();
        if (isset($array_email)) {
            $temp_email[] = '';
            foreach ($array_email as $val) {
                $temp_email[$val->email] = $val->email;
            }
        }
        $module =  'books';
        return view('contact.backend.register', compact('module', 'data', 'countContact', 'countEmail', 'temp_email'));
    }
    
    public function scheduleSampling(Request $request)
    {
        $data = Contact::where('type', 'schedule_sampling')->orderBy('id', 'DESC');
        if (is($request->keyword)) {
            $data =  $data->where(function ($query) use ($request) {
                $query->where('email', 'like', '%' . $request->keyword . '%')
                    ->orWhere('fullname', 'like', '%' . $request->keyword . '%')
                    ->orWhere('phone', 'like', '%' . $request->keyword . '%');
            });
        }
        $data = $data->paginate(env('APP_paginate'));
        if (is($request->keyword)) {
            $data->appends(['keyword' => $request->keyword]);
        }
        if (is($request->type)) {
            $data->appends(['type' => $request->type]);
        }
        $countContact = Contact::where('type', 'schedule_sampling')->count();
        $countEmail = Contact::where('type', 'schedule_sampling')->count();

        //lấy toàn bộ email
        $array_email = Contact::groupBy('email')->get();
        if (isset($array_email)) {
            $temp_email[] = '';
            foreach ($array_email as $val) {
                $temp_email[$val->email] = $val->email;
            }
        }
        $module =  'contacts';
        return view('contact.backend.schedule_sampling', compact('module', 'data', 'countContact', 'countEmail', 'temp_email'));
    }
    
    public function scheduleAnAppointment(Request $request)
    {
        $data = Contact::where('type', 'schedule_an_appointment')->orderBy('id', 'DESC');
        if (is($request->keyword)) {
            $data =  $data->where(function ($query) use ($request) {
                $query->where('email', 'like', '%' . $request->keyword . '%')
                    ->orWhere('fullname', 'like', '%' . $request->keyword . '%')
                    ->orWhere('phone', 'like', '%' . $request->keyword . '%');
            });
        }
        $data = $data->paginate(env('APP_paginate'));
        if (is($request->keyword)) {
            $data->appends(['keyword' => $request->keyword]);
        }
        if (is($request->type)) {
            $data->appends(['type' => $request->type]);
        }
        $countContact = Contact::where('type', 'schedule_an_appointment')->count();
        $countEmail = Contact::where('type', 'schedule_an_appointment')->count();

        //lấy toàn bộ email
        $array_email = Contact::groupBy('email')->get();
        if (isset($array_email)) {
            $temp_email[] = '';
            foreach ($array_email as $val) {
                $temp_email[$val->email] = $val->email;
            }
        }
        $module =  'contacts';
        return view('contact.backend.schedule_an_appointment', compact('module', 'data', 'countContact', 'countEmail', 'temp_email'));
    }
    
    public function agency(Request $request)
    {
        $data = Contact::where('type', 'agency')->orderBy('id', 'DESC');
        if (is($request->keyword)) {
            $data =  $data->where(function ($query) use ($request) {
                $query->where('email', 'like', '%' . $request->keyword . '%')
                    ->orWhere('fullname', 'like', '%' . $request->keyword . '%')
                    ->orWhere('phone', 'like', '%' . $request->keyword . '%');
            });
        }
        $data = $data->paginate(env('APP_paginate'));
        if (is($request->keyword)) {
            $data->appends(['keyword' => $request->keyword]);
        }
        if (is($request->type)) {
            $data->appends(['type' => $request->type]);
        }
        $countContact = Contact::where('type', 'agency')->count();
        $countEmail = Contact::where('type', 'agency')->count();

        //lấy toàn bộ email
        $array_email = Contact::groupBy('email')->get();
        if (isset($array_email)) {
            $temp_email[] = '';
            foreach ($array_email as $val) {
                $temp_email[$val->email] = $val->email;
            }
        }
        $module =  'contacts';
        return view('contact.backend.agency', compact('module', 'data', 'countContact', 'countEmail', 'temp_email'));
    }

    public function popup(Request $request)
    {
        $data = Contact::where('type', 'popup')->orderBy('id', 'DESC');
        if (is($request->keyword)) {
            $data =  $data->where(function ($query) use ($request) {
                $query->where('email', 'like', '%' . $request->keyword . '%')
                    ->orWhere('fullname', 'like', '%' . $request->keyword . '%')
                    ->orWhere('phone', 'like', '%' . $request->keyword . '%');
            });
        }
        $data = $data->paginate(env('APP_paginate'));
        if (is($request->keyword)) {
            $data->appends(['keyword' => $request->keyword]);
        }
        if (is($request->type)) {
            $data->appends(['type' => $request->type]);
        }
        $countContact = Contact::where('type', 'popup')->count();
        $countEmail = Contact::where('type', 'mail')->count();

        //lấy toàn bộ email
        $array_email = Contact::groupBy('email')->get();
        if (isset($array_email)) {
            $temp_email[] = '';
            foreach ($array_email as $val) {
                $temp_email[$val->email] = $val->email;
            }
        }
        $module =  'contacts';
        return view('contact.backend.popup', compact('module', 'data', 'countContact', 'countEmail', 'temp_email'));
    }
    public function subscribers(Request $request)
    {
        $data = Contact::where('type', 'email')->orderBy('id', 'DESC');
        if (is($request->keyword)) {
            $data =  $data->where('email', 'like', '%' . $request->keyword . '%');
        }
        $data = $data->paginate(env('APP_paginate'));
        if (is($request->keyword)) {
            $data->appends(['keyword' => $request->keyword]);
        }
        $module =  'contacts';
        return view('contact.backend.subscribers', compact('module', 'data'));
    }
    public function books(Request $request)
    {
        $data = Contact::where('type', 'register')->orderBy('id', 'DESC');
        if (is($request->keyword)) {
            $data =  $data->where(function ($query) use ($request) {
                $query->where('email', 'like', '%' . $request->keyword . '%')
                    ->orWhere('fullname', 'like', '%' . $request->keyword . '%')
                    ->orWhere('fullname', 'like', '%' . $request->keyword . '%')
                    ->orWhere('message', 'like', '%' . $request->keyword . '%');
            });
        }
        $data = $data->paginate(env('APP_paginate'));
        if (is($request->keyword)) {
            $data->appends(['keyword' => $request->keyword]);
        }
        $module =  'contacts';
        return view('contact.backend.books', compact('module', 'data'));
    }
    public function store(Request $request)
    {
        $details = [
            'subject' => $request->subject,
            'message' => $request->message,
        ];
        if (empty($request->email_to) || empty($request->subject) || empty($request->message)) {
            return redirect()->route('contacts.index')->with('error', "Có lỗi xảy ra. Vui lòng thực hiện lại");
        }
        dispatch(function () {
            Mail::to($request->email_to)->cc($request->email_cc)->send(new \App\Mail\SendMail($details));
        })->afterResponse();
        return redirect()->route('contacts.index')->with('success', "Gửi email thành công");
    }
}
