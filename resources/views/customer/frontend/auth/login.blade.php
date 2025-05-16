@extends('homepage.layout.home')
@section('content')
    {!! htmlBreadcrumb(trans('index.LoginAccount')) !!}
    <div class="limiter wow fadeInUp">
        <div class="container-login100">
            <div class="wrap-login100 p-t-50 p-b-90">
                <form class="login100-form validate-form flex-sb flex-w" action="{{ route('customer.login-store') }}"
                    method="POST" id="form-auth">
                    <span class="login100-form-title p-b-51">
                        ĐĂNG NHẬP
                    </span>
                    @csrf
                    {!! checkFinalValidate($errors, 'empty_user') !!}
                    <div class="wrap-input100 validate-input m-b-16" data-validate="Username is required">
                        <input class="input100 form-control @if (checkErrorValidate($errors, 'email')) is-invalid @endif"
                            type="email" name="email" placeholder="Email">
                        <span class="focus-input100"></span>
                        {!! renderErrorValidate($errors, 'email') !!}
                    </div>

                    <div class="wrap-input100 validate-input m-b-16" data-validate="Password is required">
                        <input class="input100 form-control @if (checkErrorValidate($errors, 'password')) is-invalid @endif"
                            type="password" name="password" placeholder="Mật khẩu">
                        <span class="focus-input100"></span>
                        {!! renderErrorValidate($errors, 'password') !!}
                    </div>

                    <div class="flex-sb-m w-full p-t-3 p-b-24 flex-box">
                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                            <label class="label-checkbox100" for="ckb1">
                                Ghi nhớ
                            </label>
                        </div>
                        <div class="d-none">
                            <a href="#" class="txt1">
                                Quên mật khẩu?
                            </a>
                        </div>
                    </div>
                    <div class="container-login100-form-btn m-t-17">
                        <button type="submit" class="login100-form-btn">
                            Đăng nhậP
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .home-form {
            display: none;
        }
        input {
            outline: none;
            border: none;
        }

        .form-control {
            outline: unset;
            font-size: 14px !important;
        }

        textarea {
            outline: none;
            border: none;
        }

        textarea:focus,
        input:focus {
            border-color: transparent !important;
        }

        input::-webkit-input-placeholder {
            color: #8f8fa1;
        }

        input:-moz-placeholder {
            color: #8f8fa1;
        }

        input::-moz-placeholder {
            color: #8f8fa1;
        }

        input:-ms-input-placeholder {
            color: #8f8fa1;
        }

        textarea::-webkit-input-placeholder {
            color: #8f8fa1;
        }

        textarea:-moz-placeholder {
            color: #8f8fa1;
        }

        textarea::-moz-placeholder {
            color: #8f8fa1;
        }

        textarea:-ms-input-placeholder {
            color: #8f8fa1;
        }

        label {
            display: block;
            margin: 0;
        }

        /*---------------------------------------------*/
        button {
            outline: none !important;
            border: none;
            background: transparent;
        }

        button:hover {
            cursor: pointer;
        }

        iframe {
            border: none !important;
        }


        /*//////////////////////////////////////////////////////////////////
            [ Utility ]*/
        .txt1 {
            font-size: 15px;
            line-height: 1.4;
        }



        /*//////////////////////////////////////////////////////////////////
            [ login ]*/

        .limiter {
            width: 100%;
            margin: 0 auto;
        }

        .container-login100 {
            width: 100%;
            min-height: 60vh;
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            padding: 15px;

            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            ;
        }


        .wrap-login100 {
            width: 390px;
            background: #fff;
            border-radius: 10px;
            position: relative;
        }


        /*==================================================================
            [ Form ]*/

        .login100-form {
            width: 100%;
        }

        .login100-form-title {
            font-size: 30px;
            color: #403866;
            line-height: 1.2;
            text-transform: uppercase;
            text-align: center;
            width: 100%;
            display: block;
            margin-bottom: 30px;
            margin-top: 35px;
            font-weight: bold;
        }



        /*------------------------------------------------------------------
            [ Input ]*/

        .wrap-input100 {
            width: 100%;
            position: relative;
            /* background-color: #e6e6e6; */
            border: 1px solid transparent;
            border-radius: 3px;
            margin-bottom: 15px;
        }

        .flex-box {
            display: flex;
            justify-content: space-between;
        }


        /*---------------------------------------------*/
        .input100 {
            color: #403866;
            line-height: 45px;
            font-size: 15px;
            display: block;
            width: 100%;
            background: transparent;
            height: 45px;
            padding: 0 20px 0 20px;
        }

        /*------------------------------------------------------------------
            [ Focus Input ]*/

        .focus-input100 {
            position: absolute;
            display: block;
            width: calc(100% + 2px);
            height: calc(100% + 2px);
            top: -1px;
            left: -1px;
            pointer-events: none;
            border: 1px solid var(--primary-color);
            border-radius: 3px;

            visibility: hidden;
            opacity: 0;

            -webkit-transition: all 0.4s;
            -o-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;

            -webkit-transform: scaleX(1.1) scaleY(1.3);
            -moz-transform: scaleX(1.1) scaleY(1.3);
            -ms-transform: scaleX(1.1) scaleY(1.3);
            -o-transform: scaleX(1.1) scaleY(1.3);
            transform: scaleX(1.1) scaleY(1.3);
        }

        .input100:focus+.focus-input100 {
            visibility: visible;
            opacity: 1;

            -webkit-transform: scale(1);
            -moz-transform: scale(1);
            -ms-transform: scale(1);
            -o-transform: scale(1);
            transform: scale(1);
            height: 45px;
        }

        .eff-focus-selection {
            visibility: visible;
            opacity: 1;

            -webkit-transform: scale(1);
            -moz-transform: scale(1);
            -ms-transform: scale(1);
            -o-transform: scale(1);
            transform: scale(1);
        }


        /*==================================================================
            [ Restyle Checkbox ]*/

        .input-checkbox100 {
            display: none;
        }

        .label-checkbox100 {
            font-size: 15px;
            color: #999999;
            line-height: 1.2;

            display: block;
            position: relative;
            padding-left: 26px;
            cursor: pointer;
        }

        .label-checkbox100::before {
            content: "";
            font-size: 13px;
            color: transparent;
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            width: 18px;
            height: 18px;
            border-radius: 3px;
            background: #fff;
            border: 2px solid var(--primary-color);
            left: 0;
            top: 50%;
            -webkit-transform: translateY(-50%);
            -moz-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            -o-transform: translateY(-50%);
            transform: translateY(-50%);
            margin-top: 2px;
        }

        .input-checkbox100:checked+.label-checkbox100::before {
            color: #827ffe;
            background: url('data:image/svg+xml,<svg width="15px" height="15px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M4 12.6111L8.92308 17.5L20 6.5" stroke="%23000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>');
        }

        /*------------------------------------------------------------------
            [ Button ]*/
        .container-login100-form-btn {
            width: 100%;
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            flex-wrap: wrap;
        }

        .login100-form-btn {
            font-size: 15px;
            color: #fff;
            line-height: 1.2;
            text-transform: uppercase;
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 20px;
            width: 100%;
            height: 45px;
            background-color: var(--primary-color);
            border-radius: 3px;
            -webkit-transition: all 0.4s;
            -o-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }

        .login100-form-btn:hover {
            background-color: #403866;
        }


        /*------------------------------------------------------------------
            [ Alert validate ]*/

        .validate-input {
            position: relative;
        }

        .alert-validate::before {
            content: attr(data-validate);
            position: absolute;
            max-width: 70%;
            background-color: #fff;
            border: 1px solid #c80000;
            border-radius: 3px;
            padding: 4px 25px 5px 10px;
            top: 50%;
            -webkit-transform: translateY(-50%);
            -moz-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            -o-transform: translateY(-50%);
            transform: translateY(-50%);
            right: 12px;
            pointer-events: none;

            color: #c80000;
            font-size: 14px;
            line-height: 1.4;
            text-align: left;

            visibility: hidden;
            opacity: 0;

            -webkit-transition: opacity 0.4s;
            -o-transition: opacity 0.4s;
            -moz-transition: opacity 0.4s;
            transition: opacity 0.4s;
        }

        .alert-validate::after {
            content: "\f12a";
            font-family: FontAwesome;
            display: block;
            position: absolute;
            color: #c80000;
            font-size: 18px;
            top: 50%;
            -webkit-transform: translateY(-50%);
            -moz-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            -o-transform: translateY(-50%);
            transform: translateY(-50%);
            right: 18px;
        }

        .alert-validate:hover:before {
            visibility: visible;
            opacity: 1;
        }

        @media (max-width: 992px) {
            .alert-validate::before {
                visibility: visible;
                opacity: 1;
            }
        }
    </style>
@endpush
