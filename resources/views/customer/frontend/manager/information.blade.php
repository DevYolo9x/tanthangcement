@extends('homepage.layout.home')
@section('content')
    {!! htmlBreadcrumb(trans('index.AccountInformation')) !!}
    <div class="container page-customer wow fadeInUp">
        <div class="row">
            @include('customer/frontend/auth/common/sidebar')
            <div class="col-md-9">
                <div class="underline-tabs mb-5">
                    <ul class="nav nav-tabs" id="underlineTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="nav-user-information" data-bs-toggle="tab" data-bs-target="#user-information" type="button" role="tab">
                                Thông tin tài khoản
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nav-user-password" data-bs-toggle="tab" data-bs-target="#user-password" type="button" role="tab">
                                Mật khẩu
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="underlineTabsContent">
                        <div class="tab-pane fade show active" id="user-information" role="tabpanel">
                            <form id="form-information">
                                @include('homepage.common.alert')
                                @csrf
                                <div class="form-group">
                                    <label for="validationEmail" class="form-label">Email<sup>*</sup></label>
                                    <input type="text" class="form-control" disabled value="{{ $detail->email }}" id="validationEmail" placeholder="Nhập email" name="email" aria-describedby="validationemailFeedback">
                                </div>
                                <div class="form-group">
                                    <label for="validationName" class="form-label">Họ và tên<sup>*</sup></label>
                                    <input type="text" class="form-control" value="{{ $detail->name }}" id="validationName" placeholder="Họ và tên" name="name" aria-describedby="validationnameFeedback">
                                </div>
                                <div class="box-submit">
                                    <button class="js_submit_information btn btn-info">Cập nhật</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="user-password" role="tabpanel">
                            <form id="form-password">
                                @include('homepage.common.alert')
                                @csrf
                                <div class="form-group">
                                    <label for="" class="form-label">Mật khẩu hiện tại<sup>*</sup></label>
                                    <input type="text" class="form-control" value="" id="" placeholder="" name="current_password" aria-describedby="">
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">Mật khẩu mới<sup>*</sup></label>
                                    <input type="text" class="form-control" value="" id="" placeholder="" name="old_password" aria-describedby="">
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">Nhập lại mật khẩu mới<sup>*</sup></label>
                                    <input type="text" class="form-control" value="" id="" placeholder="" name="new_password" aria-describedby="">
                                </div>
                                <div class="box-submit">
                                    <button class="js_submit_password btn btn-info">Cập nhật</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/customer.css') }}">
    <style>
        .home-form {
            display: none;
        }
    </style>
@endpush

@push('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".js_submit_information").click(function(e) {
                e.preventDefault();
                var _token = $("#form-information input[name='_token']").val();
                var name = $("#form-information input[name='name']").val();
                var phone = $("#form-information input[name='phone']").val();
                $.ajax({
                    url: "<?php echo route('customer.updateInformation'); ?>",
                    type: 'POST',
                    data: {
                        _token: _token,
                        name: name,
                        phone: phone,
                    },
                    success: function(data) {
                        if (data.status == 200) {
                            $("#form-information .alert-msg").addClass('d-none');
                            $("#form-information .alert-msg.success").removeClass('d-none');
                            $("#form-information .msg-render").html("<?php echo trans('index.InformationSuccess'); ?>");
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            $("#form-information .alert-msg").addClass('d-none');
                            $("#form-information .alert-msg.danger").removeClass('d-none');
                            $("#form-information .msg-render").html(data.error);
                        }
                    }
                });
            });
        });
        $(document).ready(function() {
            $(".js_submit_password").click(function(e) {
                e.preventDefault();
                var _token = $("#form-password input[name='_token']").val();
                var current_password = $("#form-password input[name='current_password']").val();
                var old_password = $("#form-password input[name='old_password']").val();
                var new_password = $("#form-password input[name='new_password']").val();
                $.ajax({
                    url: "<?php echo route('customer.storeChangePassword'); ?>",
                    type: 'POST',
                    data: {
                        _token: _token,
                        current_password: current_password,
                        old_password: old_password,
                        new_password: new_password,
                    },
                    success: function(data) {
                        if (data.status == 200) {
                            $("#form-password .alert-msg").addClass('d-none');
                            $("#form-password .alert-msg.success").removeClass('d-none');
                            $("#form-password .msg-render").html("<?php echo trans('index.InformationSuccess'); ?>");
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            $("#form-password .alert-msg").addClass('d-none');
                            $("#form-password .alert-msg.danger").removeClass('d-none');
                            $("#form-password .msg-render").html(data.error);
                        }
                    }
                });
            });
        });
    </script>
@endpush
