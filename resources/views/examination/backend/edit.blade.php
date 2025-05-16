@extends('dashboard.layout.dashboard')
@section('title')
<title>Cập nhập tra cứu</title>
@endsection
<!--START: breadcrumb -->
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách tra cứu",
        "src" => route('examinations.index'),
    ],
    [
        "title" => "Cập nhập",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array);
?>
@endsection
<!--END: breadcrumb -->

@section('content')
<div class="content">
    <div class=" flex items-center mt-8">
        <h1 class="text-lg font-medium mr-auto">
            Cập nhập tra cứu
        </h1>
    </div>
    <form class="grid grid-cols-12 gap-6 mt-5" role="form" action="{{route('examinations.update',['id' => $detail->id])}}" method="post" enctype="multipart/form-data">
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
                        <div class="">
                            <label class="form-label text-base font-semibold">Họ và tên</label>
                            <?php echo Form::text('fullname', $detail->fullname, ['class' => 'form-control w-full']); ?>
                        </div>
                        <div class="mt-3">
                            <label class="form-label text-base font-semibold">Mã tra cứu</label>
                            <?php echo Form::text('examination_code', $detail->examination_code, ['class' => 'form-control w-full', 'readonly' => 'readonly']); ?>
                        </div>
                        
                        <div class="mt-3 hidden">
                            <label class="form-label text-base font-semibold">Đường dẫn</label>
                            <?php echo Form::text('slug', $detail->slug, ['class' => 'form-control w-full', 'readonly' => 'readonly']); ?>
                        </div>

                        <div class="mt-3">
                            <label class="form-label text-base font-semibold">Ngày khám</label>
                            <?php echo Form::text('examination_date', date('d-m-Y', strtotime($detail->examination_date)), ['class' => 'form-control w-full date', 'placeholder' => "--/--/----"]); ?>
                        </div>

                        <div class="mt-3">
                            <label class="form-label text-base font-semibold">Ngày nhận kết quả</label>
                            <?php echo Form::text('date_of_result', date('d-m-Y', strtotime($detail->date_of_result)), ['class' => 'form-control w-full date', 'placeholder' => "--/--/----"]); ?>
                        </div>

                        <div class="mt-3">
                            <label class="form-label text-base font-semibold">Ngày trả kết quả</label>
                            <?php echo Form::text('date_of_return', date('d-m-Y', strtotime($detail->date_of_return)), ['class' => 'form-control w-full date', 'placeholder' => "--/--/----"]); ?>
                        </div>
                        
                        <div class="mt-3">
                            <label class="form-label text-base font-semibold">Mật khẩu</label>
                            <?php echo Form::text('examination_pass', $detail->examination_pass, ['class' => 'form-control w-full']); ?>
                        </div>
                        
                        <div class="mt-3">
                            <label class="form-label text-base font-semibold">Trạng thái</label>
                            <?php echo Form::textarea('status', $detail->status, ['class' => 'form-control w-full']); ?>
                        </div>

                        <div class="mt-3 hidden">
                            <label class="form-label text-base font-semibold">Mô tả</label>
                            <div class="mt-2">
                                <?php echo Form::textarea('description', $detail->description, ['id' => 'ckDescription', 'class' => 'ck-editor', 'style' => 'height:60px;font-size:14px;line-height:18px;border:1px solid #ddd;padding:10px']); ?>
                            </div>
                        </div>

                        <div class="text-right mt-5">
                            <button type="submit" class="btn btn-primary w-24">Cập nhập</button>
                        </div>
                    </div>
                    <div id="example-tab-contact" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="example-contact-tab">
                        @include('components.field.index', ['module' => $module])
                    </div>
                </div>

            </div>

            <div class=" box p-5 mt-3 hidden">
                <!-- start: SEO -->
                @include('components.seo')
                <!-- end: SEO -->
                
            </div>
            <!-- END: Form Layout -->
        </div>
        <div class=" col-span-12 lg:col-span-4">
            @include('components.image',['action' => 'update','name' => 'image','title'=> 'File đính kèm'])
            @include('components.publish')
        </div>
    </form>
</div>
@endsection

<style>
    .input-file-container,
    .note-image,
    img#mainThmb-image {
        display: none;
    }

    .uploadCkfinder.w-1\/2 {
        width: 100%;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer">
@push('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js" integrity="sha512-+UiyfI4KyV1uypmEqz9cOIJNwye+u+S58/hSwKEAeUMViTTqM9/L4lqu8UxJzhmzGpms8PzFJDzEqXL9niHyjA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        $(function() {
            $('.date').datetimepicker({
                format: 'd-m-Y',
            });
        });
    </script>
@endpush