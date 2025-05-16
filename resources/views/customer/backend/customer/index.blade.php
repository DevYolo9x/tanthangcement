@extends('dashboard.layout.dashboard')
@section('title')
<title>Danh sách khách hàng</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách khách hàng",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array);
?>
@endsection
@section('content')
<div class="content">
    <h1 class=" text-lg font-medium mt-10">
        Danh sách khách hàng
    </h1>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class=" col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2 justify-between">
            <div class="flex space-x-2">
                <select class="form-control ajax-delete-all mr10" style="width: 150px;;height:42px" data-title="Lưu ý: Khi bạn xóa danh mục nội dung tĩnh, toàn bộ nội dung tĩnh trong nhóm này sẽ bị xóa. Hãy chắc chắn rằng bạn muốn thực hiện chức năng này!" data-module="{{$module}}">
                    <option>Hành động</option>
                    <option value="">Xóa</option>
                </select>
                <form action="" class="flex space-x-2" id="search" style="margin-bottom: 0px;">
                    <div class="mr10 hidden">
                        <?php echo Form::select('order', array('0' => 'Mua hàng', '1' => 'Đã mua hàng', '2' => 'Chưa mua hàng'), request()->get('order'), ['class' => 'form-control tom-select tom-select-custom', 'data-placeholder' => "Select your favorite actors", 'style' => 'height:42px']); ?>
                    </div>
                    @if(isset($category))
                    <div style="width:250px;" class="mr10">
                        <?php echo Form::select('catalogueid', $category, request()->get('catalogueid'), ['class' => 'form-control tom-select tom-select-custom', 'data-placeholder' => "Select your favorite actors", 'style' => 'height:42px']); ?>
                    </div>
                    @endif

                    <input type="search" name="keyword" class="keyword form-control filter" placeholder="Nhập từ khóa tìm kiếm ..." autocomplete="off" value="<?php echo request()->get('keyword') ?>" style="width: 200px;">
                    <button class="btn btn-primary">
                        <i data-lucide="search"></i>
                    </button>
                </form>
            </div>
            <div class="flex items-center space-x-2">
                @can('customers_create')
                <a href="{{route('customers.create')}}" class="btn btn-primary shadow-md">Thêm mới</a>
                @endcan
                <a href="{{route('customers.export')}}" class="btn btn-success shadow-md text-white hidden">Xuất excel</a>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class=" col-span-12 lg:col-span-12">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th style="width:40px;">
                            <input type="checkbox" id="checkbox-all">
                        </th>
                        <th>Tên khách hàng</th>
                        <th class="hidden">Số dư</th>
                        <th>Ngày tạo</th>
                        @can('orders_index')
                        <th class="hidden">Mua hàng</th>
                        @endcan
                        <th>Hoạt động</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $v)
                    <tr class="odd " id="post-<?php echo $v->id; ?>">
                        <td>
                            <input type="checkbox" name="checkbox[]" value="<?php echo $v->id; ?>" class="checkbox-item">
                        </td>
                        <td class="whitespace-nowrap">
                            <div class="flex space-x-2">
                                <div class="w-10 h-10 image-fit hidden">
                                    <img alt="{{$v->name}}" class=" rounded-full" src="{{File::exists(base_path($v->image)) ? asset($v->image) : 'https://ui-avatars.com/api/?name='.$v->name}}">
                                </div>
                                <div>
                                    {{$v->name}}<br>{{$v->email}}<br>{{$v->phone}}
                                </div>
                            </div>
                        </td>
                        <?php /*<td>
                            <span class="text-danger font-bold">{{number_format($v->price,'0',',', '.')}}đ</span>
                        </td>*/ ?>
                        <td class="whitespace-nowrap">
                            {{$v->created_at}}
                        </td>
                        @can('orders_index')
                        <td class="hidden" style="width:200px">
                            @if(count($v->orders) > 0)
                            <a href="{{ route('customers.orders',['id'=>$v->id]) }}" class="btn btn-success btn-sm text-xs text-white">{{count($v->orders)}} đơn hàng</a>
                            @else
                            <span class="btn btn-danger btn-sm text-xs text-white">Chưa mua hàng</span>
                            @endif
                        </td>
                        @endcan
                        <td class="w-40">
                            @include('components.isModule',['module' => $module,'title' => 'active','id' =>
                            $v->id])
                        </td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                @can('customers_edit')
                                <a class="flex items-center mr-3" href="{{ route('customers.edit',['id'=>$v->id]) }}">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-1"></i>
                                    Edit
                                </a>
                                @endcan
                                @can('customers_index')
                                <a class="flex items-center mr-3" href="{{ route('customerOrder.index',['customerID'=>$v->id]) }}">
                                    <svg width="23px" height="23px" class="mr-1" viewBox="0 -9 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>Cart-download</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage"> <g id="Cart-download" sketch:type="MSLayerGroup" transform="translate(1.000000, 0.000000)" stroke="#6B6C6E" stroke-width="2"> <path d="M26.1,37.9 L24.1,37.9 C23.1,37.9 22.3,37.1 22.3,36.1 L13.1,6.7 C13.1,5.7 8.9,4.9 0,4.9 L0,7.9" id="Shape" sketch:type="MSShapeGroup"> </path> <path d="M43.2,37.9 L36.2,37.9" id="Shape" sketch:type="MSShapeGroup"> </path> <path d="M53.4,37.9 L55.4,37.9 C56.4,37.9 57.2,37.1 57.2,36.1 L62,9.7 C62,8.7 61.2,7.9 60.2,7.9 L58,7.9" id="Shape" sketch:type="MSShapeGroup"> </path> <path d="M14.2,8 L42.8,8" id="Shape" sketch:type="MSShapeGroup"> </path> <ellipse id="Oval" sketch:type="MSShapeGroup" cx="31.1" cy="40" rx="5.1" ry="5"> </ellipse> <ellipse id="Oval" sketch:type="MSShapeGroup" cx="48.1" cy="40" rx="5.1" ry="5"> </ellipse> <path d="M25,17 L42,17" id="Shape" sketch:type="MSShapeGroup"> </path> <path d="M27,22 L45,22" id="Shape" sketch:type="MSShapeGroup"> </path> <path d="M28,27 L52,27" id="Shape" sketch:type="MSShapeGroup"> </path> <g id="Group" transform="translate(41.000000, 0.000000)" sketch:type="MSShapeGroup"> <path d="M6.05615225,8 L1,8 C0.7,8 0.4,8.3 0.4,8.6 L8.3,20.5 C8.5,20.8 8.6,21.1 8.9,21.1 L10,21.1 C10.2,21.1 10.4,20.9 10.6,20.5 L18.6,8.6 C18.6,8.3 18.3,8 18,8 L14,8" id="Shape"> </path> <path d="M14,9.9 L14,0" id="Shape"> </path> <path d="M6,9.9 L6,0" id="Shape"> </path> </g> </g> </g> </g></svg>
                                    Order
                                </a>
                                @endcan
                                @can('customers_destroy')
                                <a class="flex items-center text-danger ajax-delete" href="javascript:;" data-id="<?php echo $v->id ?>" data-module="<?php echo $module ?>" data-child="0" data-title="Lưu ý: Khi bạn xóa thương hiệu, thương hiệu sẽ bị xóa vĩnh viễn. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!">
                                    <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete
                                </a>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        <div class=" col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center justify-center">
            {{$data->links()}}
        </div>
        <!-- END: Pagination -->
    </div>
</div>
@endsection
@push('javascript')
<script>
    /* CLICK VÀO THÀNH VIÊN*/
    $(document).on('click', '.choose', function() {
        let _this = $(this);
        $('.choose').removeClass('bg-choose'); //remove all trong các thẻ có class = choose
        _this.toggleClass('bg-choose');
        let data = _this.attr('data-info');
        data = window.atob(data); //decode base64
        let json = JSON.parse(data);
        setTimeout(function() {
            $('.fullname').html('').html(json.name);
            $('#image').attr('src', json.image);
            $('.phone').html('').html(json.phone);
            $('.email').html('').html(json.email);
            $('.address').html('').html(json.address);
            $('.updated').html('').html(json.created_at);
        }, 100); //sau 100ms thì mới thực hiện
    });
</script>
@endpush