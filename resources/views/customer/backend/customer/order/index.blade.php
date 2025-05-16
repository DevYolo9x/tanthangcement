@extends('dashboard.layout.dashboard')
@section('title')
<title>Danh sách đơn hàng</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách đơn hàng",
        "src" => route('customerOrder.index', ['customerID' => $customerID]),
    ],
    [
        "title" => "Danh sách",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array);
$product = request()->product;
if( $product > 0 ) {
    $totallAll = App\Models\Patient_payment_items::getTotalQty($product, Auth::guard('customer')->user()->id);
    $totallUse = App\Models\Patient::getTotalQtyBought($product, Auth::guard('customer')->user()->id);
    $totallRemaining = $totallAll - $totallUse;
}
?>
@endsection
@section('content')
<div class="content">
    <h1 class=" text-lg font-medium mt-10">
        Danh sách đơn hàng
    </h1>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class=" col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2 justify-between">
            @include('components.search',['module'=>$module,'htmlOption' => [],'configIs' => $configIs])
            @can('customers_create')
            <a href="{{route('customerOrder.create', ['customerID' => $customerID])}}" class="btn btn-primary shadow-md mr-2">Thêm mới</a>
            @endcan
        </div>

        <!-- BEGIN: Data List -->
        <div class=" col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        @can('customers_destroy')
                        <th style="width:40px;">
                            <input type="checkbox" id="checkbox-all">
                        </th>
                        @endcan
                        <th>STT</th>
                        <th class="w-[350px]">Tiêu đề</th>
                        <th>Sản phẩm</th>
                        <th class="text-center">NGƯỜI TẠO</th>
                        <th>NGÀY TẠO</th>
                        @include('components.table.is_thead')
                        <th>#</th>
                    </tr>
                </thead>
                <tbody id="table_data" role="alert" aria-live="polite" aria-relevant="all">
                    @foreach($data as $v)
                    <tr class="odd " id="post-<?php echo $v->id; ?>">
                        @can('customers_destroy')
                        <td>
                            <input type="checkbox" name="checkbox[]" value="<?php echo $v->id; ?>" class="checkbox-item">
                        </td>
                        @endcan
                        <td>
                            {{$data->firstItem()+$loop->index}}
                        </td>
                        <td>
                            <div class="flex">
                                <div class="flex-1">
                                    <p class="text-danger font-bold"><b>CODE:</b> #DH{{10000+$v->id}}</p>
                                    <a href="javascript:void(0)" class=" text-primary font-medium"><?php echo $v->title; ?></a>
                                </div>
                            </div>
                        </td>
                        <td>
                            Có {{ (request()->product > 0) ? \App\Models\Patient_payment_items::getTotalQtyPaymentAndProduct($v->id, request()->product) : \App\Models\Patient_payment_items::getTotalQtyPayment($v->id) }} sản phẩm
                            @if( !empty($v->payment_items) )
                            <table class="table_product mt-1">
                                <tbody>
                                    @foreach( $v->payment_items as $it )
                                    <?php $json = json_decode($it->data_json); ?>
                                    <tr>
                                        <td style="padding-inline: 20px;"><span class="text-danger font-bold">{{ $json->title }}</span> <span></span></td>
                                        <td style="padding-inline: 20px;"><strong>SL:</strong> {{ $it->quantity }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </td>
                        <td class="text-center">
                            <b>
                                {{ isset($v->user) ? $v->user->name : 'Admin' }}
                            </b>
                        </td>
                        <td>
                            @if($v->created_at)
                            {{Carbon\Carbon::parse($v->created_at)->diffForHumans()}}
                            @endif
                        </td>
                        @include('components.table.is_tbody')
                        <td class="table-report__action w-56 ">
                            <div class="flex justify-center items-center">
                                @can('patients_edit')
                                <a class="flex items-center mr-3" href="{{ route('customerOrder.edit',['customerID' => $customerID, 'orderID' => $v->id]) }}">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-1"></i>
                                    Edit
                                </a>
                                @endcan
                                @can('customers_destroy')
                                <a class="flex items-center text-danger ajax-delete" href="javascript:;" data-id="<?php echo $v->id ?>" data-module="patient_payments" data-child="0" data-title="Lưu ý: Khi bạn xóa đơn hàng, đơn hàng sẽ bị xóa vĩnh viễn. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!">
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
        <div class=" col-span-12 overflow-auto lg:overflow-visible flex justify-center" style="margin-top: -20px;">
            @if( isset($product) && $product > 0 )
                <table class="table bg-white" style="width: 100%;">
                    <tbody>
                    <tr>
                        <th class="text-center" style="padding-inline: 10px">Tổng số lượng đã mua</th>
                        <th class="text-center"  style="padding-inline: 10px">Tổng số lượng đã bán</th>
                        <th class="text-center"  style="padding-inline: 10px">Tổng số lượng còn lại</th>
                    </tr>
                    <tr>
                        <td class="text-center"  width="100" style="padding-inline: 10px">
                            <span class="font-bold" style="color: #3c8dbc">
                                {{ $totallAll }}
                            </span>
                        </td>
                        <td class="text-center"  width="100" style="padding-inline: 10px">
                            <span class="font-bold text-danger">
                                {{ $totallUse }}
                            </span>
                        </td>
                        <td class="text-center"  width="100" style="padding-inline: 10px">
                            <span class="font-bold " style="color: #3c8dbc">
                                {{ $totallRemaining }}
                            </span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            @endif
        </div>

        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        <div class=" col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center justify-center">
            {{$data->links()}}
        </div>
        <!-- END: Pagination -->
    </div>
</div>
@include('patient.backend.patient.common.style')
@endsection

@include('patient.backend.patient.common.script')