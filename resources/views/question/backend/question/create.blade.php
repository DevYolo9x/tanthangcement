@extends('dashboard.layout.dashboard')
@section('title')
<title>Thêm mới câu hỏi</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách câu hỏi",
        "src" => route('questions.index'),
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
            Thêm mới câu hỏi
        </h1>
    </div>
    <form class="grid grid-cols-12 gap-6 mt-5" role="form" action="{{route('questions.store')}}" method="post" enctype="multipart/form-data">
        <div class=" col-span-12 lg:col-span-8">
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
                            <label class="form-label text-base font-semibold">Tiêu đề câu hỏi *</label>
                            <?php echo Form::text('title', '', ['class' => 'form-control w-full title']); ?>
                        </div>
                        <div class="mt-3">
                            <label class="form-label text-base font-semibold">Họ và tên *</label>
                            <?php echo Form::text('name', '', ['class' => 'form-control w-full']); ?>
                        </div>
                        <div class="mt-3">
                            <label class="form-label text-base font-semibold">Tuổi</label>
                            <?php echo Form::text('age', '', ['class' => 'form-control w-full']); ?>
                        </div>
                        <div class="mt-3">
                            <label class="form-label text-base font-semibold">Địa chỉ</label>
                            <?php echo Form::text('address', '', ['class' => 'form-control w-full']); ?>
                        </div>
                        <div class="mt-3">
                            <label class="form-label text-base font-semibold">Email *</label>
                            <?php echo Form::text('email', '', ['class' => 'form-control w-full']); ?>
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
                            <label class="form-label text-base font-semibold">Nội dung câu hỏi</label>
                            <div class="mt-2">
                                <?php echo Form::textarea('description', '', ['id' => '', 'class' => 'w-full', 'style' => 'font-size:14px;line-height:18px;border:1px solid #ddd;padding:10px']); ?>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="form-label text-base font-semibold">Trả lời</label>
                            <div class="mt-2">
                                <?php echo Form::textarea('content', '', ['id' => 'ckContent', 'class' => 'ck-editor', 'style' => 'font-size:14px;line-height:18px;border:1px solid #ddd;padding:10px']); ?>
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
            <div class=" box p-5 pt-3">
                <div>
                    <label class="form-label text-base font-semibold">Chọn danh mục chính</label>
                    <?php echo Form::select('catalogue_id', $htmlCatalogue, old('catalogue_id'), ['class' => 'tom-select tom-select-custom w-full', 'data-placeholder' => "Select your favorite actors"]); ?>
                </div>
                <div class="mt-3 hidden">
                    <label class="form-label text-base font-semibold">Chọn danh mục phụ</label>
                    <?php echo Form::select('catalogue[]', $htmlCatalogue, null, ['multiple', 'class' => 'tom-select tom-select-custom w-full', 'data-placeholder' => "Select your favorite actors"]); ?>
                </div>
                <div class="mt-3 hidden">
                    <label class="form-label text-base font-semibold">Chọn sản phẩm</label>
                    <?php echo Form::select('products[]', $products, null, ['multiple', 'class' => 'tom-select tom-select-custom w-full', 'data-placeholder' => "Select your favorite actors"]); ?>
                </div>
            </div>
            @include('components.image',['action' => 'create','name' => 'image','title'=> 'Ảnh đại diện'])
            @include('components.tag',['module' => $module])
            <div class=" box p-5 mt-3 pt-3">
                <div class="mt-3">
                    <label class="form-label text-base font-semibold">Trạng thái trả lời</label>
                    <div class="form-check">
                        <input id="radio-is_asw-1" class="form-check-input" type="radio" name="is_asw" <?php echo (old('is_asw') == 1) ? 'checked' : '' ?> value="1">
                        <label class="form-check-label" for="radio-is_asw-1">Đã trả lời</label>
                    </div>
                    <div class="form-check mt-1">
                        <input id="radio-is_asw-2" class="form-check-input" type="radio" name="is_asw" <?php echo (old('is_asw') == 0) ? 'checked' : '' ?> value="0">
                        <label class="form-check-label" for="radio-is_asw-2">Chưa trả lời</label>
                    </div>
                </div>
            </div>
            @include('components.publish')
        </div>
    </form>
</div>
@endsection