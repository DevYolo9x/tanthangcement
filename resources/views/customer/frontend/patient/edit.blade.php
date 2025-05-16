@extends('homepage.layout.home')
@section('content')
<?php
$name = !empty(old('name')) ? old('name') : (!empty($data->name) ? $data->name : '');
$code = !empty(old('code')) ? old('code') : (!empty($data->code) ? $data->code : '');
$quantity = !empty(old('quantity')) ? old('quantity') : (!empty($data->quantity) ? $data->quantity : '');
$installation_date = !empty(old('installation_date')) ? old('installation_date') : (!empty($data->installation_date) ? date('d / m / Y', strtotime($data->installation_date)) : '');
$expiration_date = !empty(old('expiration_date')) ? old('expiration_date') : (!empty($data->expiration_date) ? date('d / m / Y', strtotime($data->expiration_date)) : '');
?>
    {!! htmlBreadcrumb($seo['meta_title']) !!}
    <div class="container page-customer wow fadeInUp">
        <div class="row">
            @include('customer/frontend/auth/common/sidebar')
            <div class="col-md-9">
                <div class="underline-tabs mb-5">
                    <ul class="nav nav-tabs" id="underlineTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="nav-user-information" data-bs-toggle="tab"
                                data-bs-target="#user-information" type="button" role="tab" aria-selected="true">
                                Cập nhật bệnh nhân
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="underlineTabsContent">
                        <div class="tab-pane fade show active" id="patient-create" role="tabpanel">
                            <form action="{{ route('patient.update', ['id' => $data->id]) }}" method="POST">
                                @include('homepage.common.alert')
                                @csrf
                                <div class="form-group">
                                    <label for="validationName" class="form-label">Họ và tên<sup>*</sup></label>
                                    <input type="text"
                                        class="form-control @if (checkErrorValidate($errors, 'name')) is-invalid @endif"
                                        value="{{ $name }}" id="validationName" name="name"
                                        aria-describedby="validationnameFeedback">
                                    {!! renderErrorValidate($errors, 'name') !!}
                                </div>
                                <div class="form-group">
                                    <label for="validationCode" class="form-label">Mã biên lai<sup>*</sup></label>
                                    <input type="text"
                                        class="form-control @if (checkErrorValidate($errors, 'code')) is-invalid @endif"
                                        value="{{ $code }}" id="validationCode" name="code"
                                        aria-describedby="validationcodeFeedback">
                                    {!! renderErrorValidate($errors, 'code') !!}
                                </div>
                                <div class="form-group">
                                    <label for="validationProduct" class="form-label">Chọn sản phẩm<sup>*</sup></label>
                                    <select class="form-control select2Product @if (checkErrorValidate($errors, 'product')) is-invalid @endif"
                                        name="product" id="validationProduct" aria-describedby="validationproductFeedback">
                                        <option value="">Chọn sản phẩm</option>
                                        @if( isset($product) )
                                            <option value="{{ $product->id }}" selected>{{ $product->title }}</option>
                                        @endif
                                    </select>
                                    {!! renderErrorValidate($errors, 'product') !!}
                                </div>
                                <div class="form-group">
                                    <label for="validationQuantity" class="form-label">Số lượng răng<sup>*</sup> <span class="inventory badge rounded-pill bg-danger">(Số lượng cập nhật nhỏ hơn {{ $maxQty }})</span></label>
                                    <input type="number"
                                        class="form-control @if (checkErrorValidate($errors, 'quantity')) is-invalid @endif"
                                        value="{{ $quantity }}" onchange="changeQuantity(this)" max="{{ $maxQty }}" id="validationQuantity"
                                        name="quantity" aria-describedby="validationquantityFeedback">
                                    {!! renderErrorValidate($errors, 'quantity') !!}
                                </div>
                                <div class="form-group">
                                    <label for="validationInstallation_date" class="form-label">Ngày lắp<sup>*</sup></label>
                                    <input type="text"
                                        class="form-control date @if (checkErrorValidate($errors, 'installation_date')) is-invalid @endif"
                                        value="{{ $installation_date }}" id="validationInstallation_date"
                                        name="installation_date" aria-describedby="validationinstallation_dateFeedback">
                                    {!! renderErrorValidate($errors, 'installation_date') !!}
                                </div>
                                <div class="form-group">
                                    <label for="validationExpiration_date" class="form-label">Ngày hết hạn bảo
                                        hành<sup>*</sup></label>
                                    <input type="text"
                                        class="form-control date @if (checkErrorValidate($errors, 'expiration_date')) is-invalid @endif"
                                        value="{{ $expiration_date }}" id="validationExpiration_date"
                                        name="expiration_date" aria-describedby="validationexpiration_dateFeedback">
                                    {!! renderErrorValidate($errors, 'expiration_date') !!}
                                </div>
                                <div class="box-submit">
                                    <button class="btn btn-info" style="background: var(--primary-color)">Cập nhật</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('customer.frontend.patient.script')