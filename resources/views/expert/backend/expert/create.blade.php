@extends('dashboard.layout.dashboard')
@section('title')
<title>Thêm mới chuyên gia</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách chuyên gia",
        "src" => route('experts.index'),
    ],
    [
        "title" => "Thêm mới",
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
            Thêm mới chuyên gia
        </h1>
    </div>
    <form class="grid grid-cols-12 gap-6 mt-5" role="form" action="{{route('experts.store')}}" method="post" enctype="multipart/form-data">
        <div class=" col-span-12 lg:col-span-8">
            <ul class="nav nav-link-tabs flex-wrap" role="tablist">
                <li id="example-homepage-tab" class="nav-item" role="presentation">
                    <button class="nav-link w-full py-2 active" data-tw-toggle="pill" data-tw-target="#example-tab-homepage" type="button" role="tab" aria-controls="example-tab-homepage" aria-selected="true">Thông tin chung</button>
                </li>
                <li id="example-filter-tab" class="nav-item" role="presentation">
                    <button class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#example-tab-filter" type="button" role="tab" aria-controls="example-tab-filter" aria-selected="true">Bộ lọc</button>
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
                            <label class="form-label text-base font-semibold">Tiêu đề chuyên gia</label>
                            <?php echo Form::text('title', '', ['class' => 'form-control w-full title']); ?>
                        </div>
                        <div class="mt-3">
                            <label class="form-label text-base font-semibold">Đường dẫn</label>
                            <div class="input-group">
                                <div class="input-group-text vertical-1"><span class="vertical-1"><?php echo url(''); ?></span>
                                </div>
                                <?php echo Form::text('slug', '', ['class' => 'form-control canonical', 'data-flag' => 0]); ?>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="form-label text-base font-semibold">Mô tả</label>
                            <div class="mt-2">
                                <?php echo Form::textarea('description', '', ['id' => 'ckDescription', 'class' => 'ck-editor-description', 'style' => 'font-size:14px;line-height:18px;border:1px solid #ddd;padding:10px']); ?>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="form-label text-base font-semibold">Chi tiết chuyên gia</label>
                            <div class="mt-2">
                                <?php echo Form::textarea('content', '', ['id' => 'ckContent', 'class' => 'ck-editor', 'style' => 'font-size:14px;line-height:18px;border:1px solid #ddd;padding:10px']); ?>
                            </div>
                        </div>
                    </div>
                    <div id="example-tab-filter" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="example-filter-tab">
                        @include('expert.backend.common.filter')
                    </div>
                    <div id="example-tab-contact" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="example-contact-tab">
                        @include('components.field.index', ['module' => $module])
                    </div>
                </div>
            </div>

            <!-- start: Album Ảnh -->
            <div class=" box p-5 mt-3 space-y-3">
                <div>
                    @include('components.dropzone',['action' => $action])
                </div>
            </div>
            <!-- END: Album Ảnh -->
            
            <div class=" box p-5 mt-3">
                <!-- start: SEO -->
                @include('components.seo')
                <!-- end: SEO -->
                <div class="text-right mt-5">
                    <button type="submit" class="btn btn-primary w-24">Lưu</button>
                </div>
            </div>
            <!-- END: Form Layout -->
        </div>
        <div class=" col-span-12 lg:col-span-4">
            @include('components.image',['action' => 'create','name' => 'image','title'=> 'Ảnh đại diện'])
            @include('components.tag',['module' => $module])
            @include('components.publish')
        </div>
    </form>
</div>
@endsection

@include('product.backend.product.common.script',['action' => 'create'])