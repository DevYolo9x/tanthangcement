@extends('dashboard.layout.dashboard')

@section('title')
<title>Cập nhập bệnh nhân</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách bệnh nhân",
        "src" => route('patients.index'),
    ],
    [
        "title" => "Cập nhập",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array);
?>
@endsection
@section('content')
<div class="content">
    <div class=" flex items-center mt-8">
        <h1 class="text-lg font-medium mr-auto">
            Cập nhập bệnh nhân
        </h1>
    </div>
    <form class="grid grid-cols-12 gap-6 mt-5" role="form" action="{{route('patients.update', ['id' => $detail->id])}}" method="post" enctype="multipart/form-data">
        <div class=" col-span-12 lg:col-span-12">
            <ul class="nav nav-link-tabs flex-wrap" role="tablist">

                <li id="example-homepage-tab" class="nav-item" role="presentation">
                    <button class="nav-link w-full py-2 active" data-tw-toggle="pill" data-tw-target="#example-tab-homepage" type="button" role="tab" aria-controls="example-tab-homepage" aria-selected="true">Thông tin chung</button>
                </li>
                @if(!$field->isEmpty())
                <li id="example-contact-tab" class="nav-item " role="presentation">
                    <button class="nav-link w-full py-2 " data-tw-toggle="pill" data-tw-target="#example-tab-contact" type="button" role="tab" aria-controls="example-tab-contact" aria-selected="true">Custom field</button>
                </li>
                @endif
            </ul>
            <!-- BEGIN: Form Layout -->
            <div class=" box p-5">
                @include('components.alert-error')
                @csrf
                <div class="tab-content">
                    <div id="example-tab-homepage" class="tab-pane leading-relaxed active" role="tabpanel" aria-labelledby="example-homepage-tab">
                        <div>
                            <label class="form-label text-base font-semibold">Tên bệnh nhân</label>
                            <?php echo Form::text('name', $detail->name, ['class' => 'form-control w-full title']); ?>
                        </div>
                        <div class="mt-3">
                            <label class="form-label text-base font-semibold">Mã biên lai</label>
                            <div class="">
                                <?php echo Form::text('code', $detail->code, ['class' => 'form-control']); ?>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="form-label text-base font-semibold">Chọn sản phẩm</label>
                            <select name="product" class="form-control tom-select tom-select-custom w-full">
                                <option value=""></option>
                                @foreach($products as $k=>$v)
                                    <option value="{{$k}}" {{ (collect($getProduct)->contains($k)) ? 'selected':'';}}>
                                        {{$v}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-3">
                            <label class="form-label text-base font-semibold">Số lượng răng @if($detail->customerid_created > 0)<span class="inventory text-danger text-sm">(Số lượng cập nhật nhỏ hơn 110)</span>@endif</label>
                            <div class="">
                                <?php echo Form::number('quantity', $detail->quantity, ['class' => 'form-control', 'id' => 'validationQuantity', 'max' => $maxQty]); ?>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="form-label text-base font-semibold">Ngày lắp</label>
                            <div class="">
                                <?php echo Form::input('text', 'installation_date', $detail->installation_date, ['class' => 'form-control datepicker_time']); ?>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="form-label text-base font-semibold">Ngày hết hạn bảo hành</label>
                            <div class="">
                                <?php echo Form::input('text', 'expiration_date', $detail->expiration_date, ['class' => 'form-control datepicker_time']); ?>
                            </div>
                        </div>
                    </div>
                    <div id="example-tab-contact" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="example-contact-tab">
                        @include('components.field.index', ['module' => $module])
                    </div>
                </div>
            </div>

            <!-- start: Album Ảnh -->
            <div class=" box p-5 mt-3 space-y-3 hidden">
                <div>
                    @include('components.dropzone',['action' => $action])
                </div>
            </div>
            <!-- END: Album Ảnh -->

            <div class=" box_ p-5 mt-3">
                <!-- start: SEO -->
                <!-- end: SEO -->
                <div class="text-right mt-5">
                    <button type="submit" class="btn btn-primary w-24">Lưu</button>
                </div>
            </div>
            <!-- END: Form Layout -->
        </div>
        <div class=" col-span-12 lg:col-span-4 hidden">
            @include('polylang.edit')
            <div class="box p-5 pt-3 mt-3">
                
            </div>
            {{-- @include('components.image',['action' => 'update','name' => 'image','title'=> 'Ảnh đại diện']) --}}
            {{-- @include('components.publish') --}}
        </div>
    </form>
</div>
@include('patient.backend.patient.common.style')
@endsection
@include('patient.backend.patient.common.script')