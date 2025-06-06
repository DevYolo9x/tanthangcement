@extends('dashboard.layout.dashboard')
@section('title')
<title>Cập nhập sản phẩm</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách sản phẩm",
        "src" => route('products.index'),
    ],
    [
        "title" => "Cập nhập sản phẩm",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array);
?>
@endsection
@section('content')
<script>
    function search(nameKey, myArray) {
        for (var i = 0; i < myArray.length; i++) {
            if (myArray[i].name === nameKey) {
                return myArray[i];
            }
        }
    }

    var array = [0, 1, 2, 3];

    var resultObject = search('0', array);
    console.log(resultObject);
</script>
<div class="content">
    <div class=" flex items-center mt-8">
        <h1 class="text-lg font-medium mr-auto">
            Cập nhập sản phẩm
        </h1>
    </div>
    <form class="grid grid-cols-12 gap-6 mt-5" role="form" action="{{route('products.update',['id' => $detail->id ])}}" method="post" enctype="multipart/form-data">
        <div class=" col-span-12 lg:col-span-8">
            @include('product.backend.product.common.tab')
            @csrf
            @include('components.alert-error')
            <div class="tab-content">
                <div id="example-tab-homepage" class="tab-pane leading-relaxed active" role="tabpanel" aria-labelledby="example-homepage-tab">
                    @include('product.backend.product.common._detail',['action' => 'update'])
                    <div class="<?php if (!in_array('attributes', $dropdown)) { ?>hidden<?php } ?>">
                    </div>
                </div>
                <div id="example-tab-contact" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="example-contact-tab">
                    @include('components.field.index', ['module' => $module])
                </div>
                <div id="example-tab-attr" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="example-attr-tab">
{{--                    @include('product.backend.product.common.stock',['action' => 'update'])--}}
                    @include('product.backend.product.common.attribute',['action' => 'update'])
                </div>
                <?php /*<div id="example-tab-stock" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="example-stock-tab">
                    @include('product.backend.product.common.stock',['action' => 'update'])
                </div>*/ ?>
            </div>

            <div class=" box p-5 mt-3">
                <!-- start: SEO -->
                @include('components.seo')
                <!-- end: SEO -->
                <div class="text-right mt-5">
                    <button type="submit" class="btn btn-primary w-24">Cập nhập</button>
                </div>
            </div>
            <!-- END: Form Layout -->
        </div>
        <div class="col-span-12 lg:col-span-4">
            @include('polylang.edit',['module' => $module])
            <div class="box p-5 pt-3 mt-3">
                <div>
                    <label class="form-label text-base font-semibold">Chọn danh mục chính</label>
                    <?php echo Form::select('catalogueid', $catalogues, $detail->catalogue_id, ['class' => 'tom-select tom-select-custom w-full', 'data-placeholder' => "Tìm kiếm danh mục...", 'required']); ?>
                </div>
                <div class="mt-3">
                    <label class="form-label text-base font-semibold">Chọn danh mục phụ</label>
                    <select name="catalogue[]" class="form-control tom-select tom-select-custom w-full" multiple>
                        <option value=""></option>
                        @foreach($catalogues as $k=>$v)
                        <option value="{{$k}}" {{ (collect($getCatalogue)->contains($k)) ? 'selected':'';}}>
                            {{$v}}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-3 <?php if (!in_array('brands', $dropdown)) { ?>hidden<?php } ?>">
                    <label class="form-label text-base font-semibold">Chọn thương hiệu</label>
                    <?php echo Form::select('brand_id', $brands, $detail->brand_id, ['class' => 'tom-select tom-select-custom w-full', 'data-placeholder' => "Tìm kiếm thương hiệu...", 'required']); ?>
                </div>
                @include('components.tag',['module' => $module])
            </div>

            <div class="box p-5 pt-3 mt-3 hidden">
                <div class="mt-3">
                    <label class="form-label text-base font-semibold">Chọn loại thuộc tính</label>
                    <select name="type_attr" class="form-control tom-select tom-select-custom w-full">
                        <option value=""></option>
                        @foreach($listAttr as $k=>$v)
                        <option value="{{$v->id}}" {{ ( $v->id == $detail->type_attr ) ? 'selected':'';}}>
                            {{$v->title}}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            @include('components.image',['action' => 'update','name' => 'image','title'=> 'Ảnh đại diện'])
            @include('components.publish')

        </div>
    </form>

    <div class="box mt-5 p-5 hide hidden">
        <ul class="nav nav-tabs" role="tablist">
            <li id="example-1-tab" class="nav-item flex-1" role="presentation"> <button class="nav-link w-full py-2 active" data-tw-toggle="pill" data-tw-target="#example-tab-1" type="button" role="tab" aria-controls="example-tab-1" aria-selected="true">Tồn kho
                </button> </li>
            <li id="example-2-tab" class="nav-item flex-1" role="presentation"> <button class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#example-tab-2" type="button" role="tab" aria-controls="example-tab-2" aria-selected="false">Lịch sử kho </button> </li>
        </ul>
        <div class="tab-content border-l border-r border-b">
            <div id="example-tab-1" class="tab-pane leading-relaxed p-5 active space-y-3" role="tabpanel" aria-labelledby="example-1-tab">
                <div>
                    <select class="form-control tom-select tom-select-custom w-full s_selectAddress">
                        <option value="0">Chọn chi nhánh</option>
                        @foreach($address as $k=>$v)
                        <option value="{{$v['id']}}">
                            {{$v['title']}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap">Sản phẩm</th>
                                <th class="whitespace-nowrap">Tồn kho</th>
                                <th class="whitespace-nowrap">Có thể bán</th>
                                <th class="whitespace-nowrap">Đang giao dịch</th>
                                <th class="whitespace-nowrap">Hàng đang về</th>
                            </tr>
                        </thead>
                        <tbody id="s_tbodyHtmlStock">
                            @if($detail->type == 'simple')
                            @if(!empty($product_stocks) && count($product_stocks) > 0)
                            @foreach($product_stocks as $item)
                            <tr>
                                <td class="whitespace-nowrap">
                                    {{$detail->title}}
                                </td>
                                <td class="whitespace-nowrap">
                                    {{$item->sum('value')}}
                                </td>
                                <td class="whitespace-nowrap">
                                    <?php
                                    if ($detail['inventory'] == 1 && $detail['inventoryPolicy'] == 0) {
                                        echo $item->sum('value') - $item->sum('stockDeal');
                                    } else {
                                        echo "∞+";
                                    }
                                    ?>
                                </td>
                                <td class="whitespace-nowrap">
                                    {{$item->sum('stockOrder')}}
                                </td>
                                <td class="whitespace-nowrap">
                                    {{$item->sum('stockComing')}}
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            @else
                            @if(!empty($detail) && count($detail->product_versions) > 0)
                            @foreach($detail->product_versions as $item)
                            <tr>
                                <td class="whitespace-nowrap">
                                    {{collect(json_decode($item['title_version'],TRUE))->join(', ','')}}
                                </td>
                                <td class="whitespace-nowrap">
                                    {{$item->product_stocks->sum('value')}}
                                </td>
                                <td class="whitespace-nowrap">
                                    <?php
                                    if ($item['_stock_status'] == 1 && $item['_outstock_status'] == 0) {
                                        echo $item->product_stocks->sum('value') - $item->product_stocks->sum('stockDeal');
                                    } else {
                                        echo "∞+";
                                    }
                                    ?>
                                </td>
                                <td class="whitespace-nowrap">
                                    {{$item->product_stocks->sum('stockOrder')}}
                                </td>
                                <td class="whitespace-nowrap">
                                    {{$item->product_stocks->sum('stockComing')}}
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
            <div id="example-tab-2" class="tab-pane leading-relaxed p-5" role="tabpanel" aria-labelledby="example-2-tab">
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-4">
                        <?php echo Form::text('datePSH', '', ['class' => 'form-control h-10 s_searchPSH',  'autocomplete' => 'off']); ?>
                    </div>
                    <div class="col-span-4">
                        <select class="form-control tom-select tom-select-custom w-full s_searchPSH" name="addressPSH">
                            <option value="0">Chọn chi nhánh</option>
                            @foreach($address as $k=>$v)
                            <option value="{{$v['id']}}">
                                {{$v['title']}}
                            </option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="mt-5 overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap">Ngày ghi nhận</th>
                                <th class="whitespace-nowrap">Phiên bản</th>
                                <th class="whitespace-nowrap">Nhân viên</th>
                                <th>Thao tác</th>
                                <th class="whitespace-nowrap">Số lượng thay đổi</th>
                                <th class="whitespace-nowrap">Tồn kho</th>
                                <th class="whitespace-nowrap">Chi nhánh</th>
                            </tr>
                        </thead>
                        <tbody id="s_tbodyHtmlPSH">

                        </tbody>
                    </table>
                </div>
                <div class="mt-5 overflow-x-auto s_paginatePSH">

                </div>
            </div>
        </div>

    </div>
</div>
@include('product.backend.product.common.script',['action' => 'update'])
<style>
    .dz-preview {
        border-radius: 10px;
        -webkit-box-shadow: -8px -4px 57px -34px rgb(66 68 90);
        -moz-box-shadow: -8px -4px 57px -34px rgba(66, 68, 90, 1);
        box-shadow: -8px -4px 57px -34px rgb(66 68 90);
    }
</style>
@endsection
@push('javascript')
<script type="text/javascript" src="{{asset('library/daterangepicker/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset('library/daterangepicker/daterangepicker.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('library/daterangepicker/daterangepicker.css')}}" />
<script type="text/javascript">
    $(function() {
        $('input[name="datePSH"]').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD',
                separator: " to "
            }
        });
    });
</script>
<script>
    $(document).on('change', '.s_selectAddress', function(e) {
        e.preventDefault();
        var value = $(this).val()
        $.post(BASE_URL_AJAX + "products/ajax/address-stock", {
                addressID: $(this).val(),
                productID: <?php echo $detail->id ?>,
                "_token": $('meta[name="csrf-token"]').attr("content"),
            },
            function(data) {
                $('#s_tbodyHtmlStock').html(data)
            });
    })
    $(document).on('click', '.s_paginatePSH a', function(event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        get_list_object_PSH(page);
    });
    $(document).on('change', '.s_searchPSH', function(e) {
        get_list_object_PSH(1)
    })

    function get_list_object_PSH(page) {
        $.post(BASE_URL_AJAX + "products/ajax/product-stock-histories", {
                addressID: $('select[name="addressPSH"]').val(),
                date: $('input[name="datePSH"]').val(),
                productID: <?php echo $detail->id ?>,
                page: page,
                "_token": $('meta[name="csrf-token"]').attr("content"),
            },
            function(data) {
                $('#s_tbodyHtmlPSH').html(data['html'])
                $('.s_paginatePSH').html(data['paginate'])
            });
    }

</script>
@endpush